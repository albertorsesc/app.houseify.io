<?php

namespace Tests\Feature\Api\Properties\Actions;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class InterestedInPropertyTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.';

    protected function setUp () : void
    {
        parent::setUp();
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/properties/{property}/interested']
     */
    public function guests_cannot_interest_a_property()
    {
        $this->signIn();
        $property = $this->create(Property::class);
        $this->logout();
        $this->assertEquals(0, $property->interests->count());

        $this->postJson(
            route($this->routePrefix . 'interested', $property)
        )->assertUnauthorized();

        $this->assertCount(0, $property->fresh()->interests);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/properties/{property}/interested']
     */
    public function authenticated_user_can_be_interested_in_a_property()
    {
        $this->signIn();

        $property = $this->create(Property::class);
        $this->assertCount(0, $property->interests);

        $this->postJson(route($this->routePrefix . 'interested', $property->slug));

        $this->assertCount(1, $property->fresh()->interests);

        $this->assertDatabaseHas('interests', [
            'user_id' => auth()->id(),
            'interestable_id' => $property->id,
            'interestable_type' => get_class($property)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/properties/{property}/uninterested']
     */
    public function authenticated_user_can_be_uninterested_in_a_property()
    {
        $this->signIn();

        $property = $this->create(Property::class);
        $this->assertCount(0, $property->interests);

        $property->interested();
        $this->assertCount(1, $property->fresh()->interests);

        $this->deleteJson(route($this->routePrefix . 'uninterested', $property));
        $this->assertCount(0, $property->fresh()->interests);

        $this->assertDatabaseMissing('interests', [
            'user_id' => auth()->id(),
            'interestable_id' => $property->id,
            'interestable_type' => get_class($property)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_only_be_interested_in_a_property_once()
    {
        $this->signIn();
        $property = $this->create(Property::class);

        $property->interested();
        $property->interested();

        $this->assertCount(1, $property->fresh()->interests);
    }
}
