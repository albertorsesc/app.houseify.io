<?php

namespace Tests\Unit\Models\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\{PropertyType, PropertyCategory};

class PropertyCategoryTest extends PropertyTestCase
{
    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_category_belongs_to_a_property_type()
    {
        $this->assertInstanceOf(
            PropertyType::class,
            PropertyCategory::first()->propertyType
        );
    }
}
