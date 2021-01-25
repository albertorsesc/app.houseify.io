<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthUserPropertiesTest extends PropertyTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     * @only ['authenticated', 'seller']
    */
    public function authorized_user_can_get_own_properties()
    {
        $this->signIn();

        $this->create(Property::class);

        $response = $this->getJson(route('api.me.properties'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'title' => auth()->user()->properties->first()->title,
                ]
            ]
        ]);
    }
}
