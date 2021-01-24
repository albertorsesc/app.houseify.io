<?php

namespace Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\PropertyCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyCategoriesTest extends PropertyTestCase
{
    private string $routePrefix = 'api.property-categories.';

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/property-categories']
     */
    public function authenticated_user_can_get_all_property_categories()
    {
        $this->signIn();

        $propertyCategory = PropertyCategory::orderBy('display_name')->first();

        $response = $this->getJson(route($this->routePrefix . 'index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'propertyType',
                    'name',
                    'displayName',
                ]
            ]
        ]);
    }
}
