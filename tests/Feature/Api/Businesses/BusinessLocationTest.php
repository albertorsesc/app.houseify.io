<?php

namespace Tests\Feature\Api\Businesses;

use Illuminate\Support\Arr;
use Tests\BusinessTestCase;
use App\Models\Businesses\Business;
use Database\Seeders\{CountrySeeder, StateSeeder};

class BusinessLocationTest extends BusinessTestCase
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
     * @endpoint ['POST' => '/api/businesses/{business}/location']
     */
    public function store_a_business_location()
    {
        $business = $this->create(Business::class);
        $businessLocation = $this->makeBusinessLocation($business);

        $response = $this->postJson(
            route('api.businesses.location.store', $business),
            Arr::except($businessLocation->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'address' => $business->fresh()->location->address
            ]
        ]);

        $this->assertDatabaseHas('locations', $business->fresh()->location->toArray());
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/businesss/locations/{location}']
     */
    public function update_an_business_location()
    {
        $business = $this->create(Business::class);
        $businessLocation = $this->createBusinessLocation($business);
        $businessLocationData = $this->makeBusinessLocation($business);

        $response = $this->putJson(
            route('api.businesses.location.update', $business),
            Arr::except($businessLocationData->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertOk();
        $response->assertJson(['data' => ['address' => $businessLocationData->address]]);

        $this->assertDatabaseHas('locations', $businessLocationData->toArray());
    }
}
