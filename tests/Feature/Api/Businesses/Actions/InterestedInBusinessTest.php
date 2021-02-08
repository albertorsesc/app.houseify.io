<?php

namespace Tests\Feature\Api\Businesses\Actions;

use Tests\TestCase;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InterestedInBusinessTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.businesses.';

    protected function setUp () : void
    {
        parent::setUp();
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/businesses/{property}/interested']
     */
    public function guests_cannot_interest_a_property()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->logout();
        $this->assertEquals(0, $business->interests->count());

        $this->postJson(
            route($this->routePrefix . 'interested', $business)
        )->assertUnauthorized();

        $this->assertCount(0, $business->fresh()->interests);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/businesses/{property}/interested']
     */
    public function authenticated_user_can_be_interested_in_a_property()
    {
        $this->signIn();

        $business = $this->create(Business::class);
        $this->assertCount(0, $business->interests);

        $this->postJson(route($this->routePrefix . 'interested', $business->slug));

        $this->assertCount(1, $business->fresh()->interests);

        $this->assertDatabaseHas('interests', [
            'user_id' => auth()->id(),
            'interestable_id' => $business->id,
            'interestable_type' => get_class($business)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/businesses/{property}/uninterested']
     */
    public function authenticated_user_can_be_uninterested_in_a_property()
    {
        $this->signIn();

        $business = $this->create(Business::class);
        $this->assertCount(0, $business->interests);

        $business->interested();
        $this->assertCount(1, $business->fresh()->interests);

        $this->deleteJson(route($this->routePrefix . 'uninterested', $business));
        $this->assertCount(0, $business->fresh()->interests);

        $this->assertDatabaseMissing('interests', [
            'user_id' => auth()->id(),
            'interestable_id' => $business->id,
            'interestable_type' => get_class($business)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_only_be_interested_in_a_property_once()
    {
        $this->signIn();
        $business = $this->create(Business::class);

        $business->interested();
        $business->interested();

        $this->assertCount(1, $business->fresh()->interests);
    }
}
