<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class InterestingPropertiesTest extends PropertyTestCase
{
    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_get_own_interested_properties()
    {
        $this->signIn();
        $property = $this->create(Property::class);
        $this->signOut();

        $this->signIn();

        $property->interested();

        $response = $this->getJson(route('api.me.properties.interested'));
        $response->assertOk();
        $this->assertEquals(
            auth()->id(),
            $response->getOriginalContent()[0]->interests->first()->interested_by
        );
    }
}
