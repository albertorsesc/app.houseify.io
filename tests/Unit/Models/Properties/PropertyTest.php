<?php

namespace Tests\Unit\Models\Properties;

use App\Models\Interest;
use App\Models\Location;
use App\Models\User;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StateSeeder;
use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyFeature;

class PropertyTest extends PropertyTestCase
{

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_model_belongs_to_seller()
    {
        $this->signIn();

        $this->assertInstanceOf(
            User::class, $this->create(Property::class)->seller
        );
    }

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
     *   @test
     *   @throws \Throwable
     */
    public function property_has_one_property_feature()
    {
        $this->signIn();
        $propertyFeature = $this->create(PropertyFeature::class);

        $this->assertInstanceOf(PropertyFeature::class, $propertyFeature->property->fresh()->propertyFeature);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_has_many_interests()
    {
        $this->signIn();

        $property = $this->create(Property::class);

        $property->interested();
        $this->assertInstanceOf(Interest::class, $property->fresh()->interests->first());
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

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_has_one_location()
    {
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class,
        ]);
        $this->signIn();
        $property = $this->create(Property::class);
        $this->createPropertyLocation($property);

        $this->assertInstanceOf(Location::class, $property->fresh()->location);
    }
}
