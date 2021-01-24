<?php

namespace Tests\Unit\Models\Properties;

use Tests\PropertyTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Properties\{PropertyType, PropertyCategory};

class PropertyTypeTest extends PropertyTestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_type_has_many_property_categories()
    {
        $propertyType = PropertyType::query()->inRandomOrder()->first();
        PropertyCategory::where('property_type_id', $propertyType->id)->first();

        $this->assertInstanceOf(PropertyCategory::class, $propertyType->propertyCategories->first());
    }
}
