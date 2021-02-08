<?php

namespace Tests\Feature\Api\Properties\Actions;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class ToggleStatusTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.';

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/properties/{property}/toggle']
     */
    public function authorized_user_can_toggle_property()
    {
        $this->signIn();

        $property = $this->create(Property::class, ['status' => false]);
        $this->assertFalse($property->status);

        $this->putJson(route($this->routePrefix . 'toggle', $property));
        $this->assertTrue($property->fresh()->status);

        $this->putJson(route($this->routePrefix . 'toggle',  $property));
        $this->assertFalse($property->fresh()->status);
    }
}
