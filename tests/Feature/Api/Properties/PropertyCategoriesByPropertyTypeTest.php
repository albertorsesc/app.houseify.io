<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\PropertyType;

class PropertyCategoriesByPropertyTypeTest extends PropertyTestCase
{
    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/property-types/{propertyType}/property-categories']
     */
    public function get_all_property_categories_by_property_type()
    {
        $this->signIn();

        $propertyType = PropertyType::query()->inRandomOrder()->first();
        $propertyCategory = $propertyType->propertyCategories->first();

        $response = $this->getJson(route('api.property-types.property-categories', $propertyType));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $propertyCategory->id,
                    'name' => $propertyCategory->name,
                    'displayName' => $propertyCategory->display_name,
                ]
            ]
        ]);
    }
}
