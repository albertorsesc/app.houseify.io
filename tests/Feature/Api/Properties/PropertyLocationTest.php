<?php

namespace Tests\Feature\Api\Properties;


use Tests\PropertyTestCase;
use Illuminate\Support\Arr;
use App\Models\Properties\Property;
use Database\Seeders\{StateSeeder, CountrySeeder};
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyLocationTest extends PropertyTestCase
{
    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class
        ]);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['POST' => '/api/properties/{property}/location']
     */
    public function store_a_property_location()
    {
        $property = $this->create(Property::class);
        $propertyLocation = $this->makePropertyLocation($property);

        $response = $this->postJson(
            route('api.properties.location.store', $property),
            Arr::except($propertyLocation->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'address' => $property->location->address
            ]
        ]);

        $this->assertDatabaseHas('locations', $property->fresh()->location->toArray());
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/propertys/locations/{location}']
     */
    public function update_an_property_location()
    {
        $property = $this->create(Property::class);
        $propertyLocation = $this->createPropertyLocation($property);
        $propertyLocationData = $this->makePropertyLocation($property);

        $response = $this->putJson(
            route('api.properties.location.update', $property),
            Arr::except($propertyLocationData->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertOk();
        $response->assertJson(['data' => ['address' => $propertyLocationData->address]]);

        $this->assertDatabaseHas('locations', $propertyLocationData->toArray());
    }
}
