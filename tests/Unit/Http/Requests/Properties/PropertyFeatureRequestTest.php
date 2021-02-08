<?php

namespace Tests\Unit\Http\Requests\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyFeature;

class PropertyFeatureRequestTest extends PropertyTestCase
{
    private $property;
    private string $routePrefix = 'api.properties.features.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
        $this->property = $this->create(Property::class);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_size_must_not_be_greater_than_100_million()
    {
        $validatedField = 'property_size';
        $brokenRule = 100000001;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $propertyFeature = $this->create(PropertyFeature::class, ['property_id' => $this->property->id]);
        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_size_must_be_an_unsigned_integer()
    {
        $validatedField = 'property_size';
        $brokenRule = -1;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_be_an_integer()
    {
        $validatedField = 'construction_size';
        $brokenRule = 'non-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => 'not-integer'])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_be_an_unsigned_integer()
    {
        $validatedField = 'construction_size';
        $brokenRule = -1;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_not_be_greater_than_100_million()
    {
        $validatedField = 'construction_size';
        $brokenRule = 100000001;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_be_an_integer()
    {
        $validatedField = 'level_count';
        $brokenRule = 'not-integer';
        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_be_an_unsigned_integer()
    {
        $validatedField = 'level_count';
        $brokenRule = -1;
        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_not_be_greater_than_100()
    {
        $validatedField = 'level_count';
        $brokenRule = 101;
        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_be_an_integer()
    {
        $validatedField = 'room_count';
        $brokenRule = 'not-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => 'not-integer'])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_be_an_unsigned_integer()
    {
        $validatedField = 'room_count';
        $brokenRule = -1;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_not_be_greater_than_1000()
    {
        $validatedField = 'room_count';
        $brokenRule = 1001;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_be_an_integer()
    {
        $validatedField = 'bathroom_count';
        $brokenRule = 'non-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_be_an_unsigned_integer()
    {
        $validatedField = 'bathroom_count';
        $brokenRule = -1;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_not_be_greater_than_100()
    {
        $validatedField = 'bathroom_count';
        $brokenRule = 101;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_be_an_integer()
    {
        $validatedField = 'half_bathroom_count';
        $brokenRule = 'not-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_be_an_unsigned_integer()
    {
        $validatedField = 'half_bathroom_count';
        $brokenRule = -1;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_not_be_greater_than_100()
    {
        $validatedField = 'half_bathroom_count';
        $brokenRule = 101;

        $this->postJson(
            route($this->routePrefix . 'store', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->putJson(
            route($this->routePrefix . 'update', $this->property),
            $this->make(PropertyFeature::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
