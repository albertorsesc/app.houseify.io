<?php

namespace Feature\Api\Properties;

use Tests\PropertyTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypesTest extends PropertyTestCase
{
    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/property-types']
     */
    public function authenticated_user_can_get_all_property_types()
    {
        $this->signIn();

        $response = $this->getJson(route('api.property-types.index'));
        $response->assertOk();
        $response->assertJsonStructure(['data' => [['id', 'name', 'display_name',]]]);
    }

}
