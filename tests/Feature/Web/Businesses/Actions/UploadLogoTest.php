<?php

namespace Tests\Feature\Web\Businesses\Actions;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadLogoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function business_owner_can_upload_a_logo()
    {
        \Storage::fake();
        $this->signIn();

        $business = $this->create(Business::class);
        $logo = [
            'logo' => UploadedFile::fake()->image('business-logo.jpeg', 1, 1)
        ];

        $response = $this->putJson(route('businesses.logo.store', $business), $logo);
        $response->assertRedirect(route('web.businesses.show', $business));

        $this->assertTrue(isset($business->fresh()->logo));
        \Storage::assertExists($business->logo);
    }
}
