<?php

namespace Tests\Unit\Http\Requests\Properties;

use App\Models\Location;
use App\Models\Properties\Property;
use Illuminate\Support\Str;
use Tests\PropertyTestCase;
use Database\Seeders\{CountrySeeder, StateSeeder};

class LocationRequestTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.location.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class
        ]);
        $this->signIn();
    }

    public function property_id_is_required()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Location::class, ['property_id' => null])->toArray()
        )->assertJsonValidationErrors('property_id');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Location::class)),
            $this->make(Location::class, ['property_id' => null])->toArray()
        )->assertJsonValidationErrors('property_id');
    }

    public function property_id_must_exist_in_properties_table()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Location::class, ['property_id' => 10001])->toArray()
        )->assertJsonValidationErrors('property_id');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Location::class)),
            $this->make(Location::class, ['property_id' => 10001])->toArray()
        )->assertJsonValidationErrors('property_id');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function address_must_not_exceed_255_characters()
    {
        $validatedField = 'address';
        $brokenRule = Str::random(256);

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function neighborhood_is_required()
    {
        $validatedField = 'neighborhood';
        $brokenRule = null;

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function neighborhood_must_not_exceed_255_characters()
    {
        $validatedField = 'neighborhood';
        $brokenRule = Str::random(256);

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function city_is_required()
    {
        $validatedField = 'city';
        $brokenRule = null;

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function city_must_not_exceed_255_characters()
    {
        $validatedField = 'city';
        $brokenRule = Str::random(256);

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function state_id_is_required()
    {
        $validatedField = 'state_id';
        $brokenRule = null;

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function state_id_must_exist_in_states_table()
    {
        $validatedField = 'state_id';
        $brokenRule = 10001;

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function zip_code_must_not_exceed_20_characters()
    {
        $validatedField = 'zip_code';
        $brokenRule = Str::random(21);

        $property = $this->create(Property::class);
        $this->postJson(
            route($this->routePrefix . 'store', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Location::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
