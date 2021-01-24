<?php

namespace Tests\Unit\Models\Properties;

use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use Tests\PropertyTestCase;

class PropertyTest extends PropertyTestCase
{
    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_model_belongs_to_property_category()
    {
        $this->signIn();

        $this->assertInstanceOf(
            PropertyCategory::class,
            $this->create(Property::class)->propertyCategory
        );
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function can_get_published_properties()
    {
        $this->signIn();

        $inactiveProperty = $this->create(Property::class, ['status' => false]);
        $activeProperty = $this->create(Property::class, ['status' => true]);

        $this->assertCount(1, Property::query()->isPublished()->get());
    }
}
