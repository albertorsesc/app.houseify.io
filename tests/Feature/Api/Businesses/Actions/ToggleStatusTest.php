<?php

namespace Tests\Feature\Api\Businesses\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Businesses\Business;

class ToggleStatusTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.businesses.';

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/businesses/{business}/toggle']
     */
    public function authorized_user_can_toggle_published_and_unpublished_a_business()
    {
        $this->signIn();

        $business = $this->create(Business::class, ['status' => false]);
        $this->assertFalse($business->status);

        $this->putJson(route($this->routePrefix . 'toggle', $business));
        $this->assertTrue($business->fresh()->status);

        $this->putJson(route($this->routePrefix . 'toggle',  $business));
        $this->assertFalse($business->fresh()->status);
    }
}
