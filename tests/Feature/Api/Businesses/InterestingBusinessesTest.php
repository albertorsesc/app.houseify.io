<?php

namespace Tests\Feature\Api\Businesses;

use Tests\TestCase;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterestingBusinessesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_get_own_interested_businesses()
    {
        $this->signIn();
        $property = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $property->interested();

        $response = $this->getJson(route('api.me.businesses.interested'));
        $response->assertOk();
        $this->assertEquals(
            auth()->id(),
            $response->getOriginalContent()[0]->interests->first()->interested_by
        );
    }
}
