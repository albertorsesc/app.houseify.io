<?php

namespace Tests;

use App\Models\Location;
use App\Models\Properties\Property;
use Illuminate\Support\Arr;
use Database\Seeders\PropertyTypeSeeder;
use App\Models\Properties\PropertyCategory;
use Database\Seeders\PropertyCategorySeeder;
use App\Models\Properties\Concerns\BusinessType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp () : void
    {
        parent::setUp();
        $this->loadPropertySeeders();
    }

    public function loadPropertySeeders()
    {
        $this->loadSeeders([
            PropertyTypeSeeder::class,
            PropertyCategorySeeder::class,
        ]);
    }

    public function makeProperty() : array
    {
        return [
            'title' => 'Beautiful House near Beach',
            'property_category_id' => PropertyCategory::query()->inRandomOrder()->first()->id,
            'business_type' => Arr::random(BusinessType::all()->toArray()),
            'price' => rand(1000, 100000000),
            'phone' => '6862894998',
            'email' => 'alberto@email.com',
            'comments' => 'Aditional Comments',
        ];
    }

    public function makePropertyLocation(Property $property)
    {
        return $this->make(Location::class, [
            'locationable_id' => $property->id,
            'locationable_type' => get_class($property)
        ]);
    }

    public function createPropertyLocation(Property $property)
    {
        return $this->create(Location::class, [
            'locationable_id' => $property->id,
            'locationable_type' => get_class($property)
        ]);
    }
}
