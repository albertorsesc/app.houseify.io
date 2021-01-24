<?php

namespace Tests\Unit\Http\Requests\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\PropertyFeature;

class PropertyFeatureRequestTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.features.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_id_is_required()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['property_id' => null])->toArray()
        )->assertJsonValidationErrors('property_id');
    }

    public function property_id_must_be_equal_to_property_feature_property()
    {
        $propertyFeature = $this->create(PropertyFeature::class);
        $propertyFeature2 = $this->create(PropertyFeature::class);

        $propertyFeatureData = $this->make(PropertyFeature::class, [
            'property_id' => $propertyFeature2->property_id
        ]);

        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $propertyFeatureData->toArray()
        )->assertJsonValidationErrors('property_id');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_id_must_exist_in_properties_table()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['property_id' => 10001])->toArray()
        )->assertJsonValidationErrors('property_id');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_size_must_not_be_greater_than_100_million()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['property_size' => 100000001])->toArray()
        )->assertJsonValidationErrors('property_size');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['property_size' => 100000001])->toArray()
        )->assertJsonValidationErrors('property_size');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_size_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['property_size' => -1])->toArray()
        )->assertJsonValidationErrors('property_size');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['property_size' => -1])->toArray()
        )->assertJsonValidationErrors('property_size');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_be_an_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['construction_size' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('construction_size');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['construction_size' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('construction_size');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['construction_size' => -1])->toArray()
        )->assertJsonValidationErrors('construction_size');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['construction_size' => -1])->toArray()
        )->assertJsonValidationErrors('construction_size');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function construction_size_must_not_be_greater_than_100_million()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['construction_size' => 100000001])->toArray()
        )->assertJsonValidationErrors('construction_size');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['construction_size' => 100000001])->toArray()
        )->assertJsonValidationErrors('construction_size');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_be_an_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['level_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('level_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['level_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('level_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['level_count' => -1])->toArray()
        )->assertJsonValidationErrors('level_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['level_count' => -1])->toArray()
        )->assertJsonValidationErrors('level_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function level_count_must_not_be_greater_than_100()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['level_count' => 101])->toArray()
        )->assertJsonValidationErrors('level_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['level_count' => 101])->toArray()
        )->assertJsonValidationErrors('level_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_be_an_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['room_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('room_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['room_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('room_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['room_count' => -1])->toArray()
        )->assertJsonValidationErrors('room_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['room_count' => -1])->toArray()
        )->assertJsonValidationErrors('room_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function room_count_must_not_be_greater_than_1000()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['room_count' => 1001])->toArray()
        )->assertJsonValidationErrors('room_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['room_count' => 1001])->toArray()
        )->assertJsonValidationErrors('room_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_be_an_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['bathroom_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['bathroom_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('bathroom_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['bathroom_count' => -1])->toArray()
        )->assertJsonValidationErrors('bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['bathroom_count' => -1])->toArray()
        )->assertJsonValidationErrors('bathroom_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function bathroom_count_must_not_be_greater_than_100()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['bathroom_count' => 101])->toArray()
        )->assertJsonValidationErrors('bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['bathroom_count' => 101])->toArray()
        )->assertJsonValidationErrors('bathroom_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_be_an_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => 'not-integer'])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_be_an_unsigned_integer()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => -1])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => -1])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function half_bathroom_count_must_not_be_greater_than_100()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => 101])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');

        $propertyFeature = $this->create(PropertyFeature::class);
        $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature),
            $this->make(PropertyFeature::class, ['half_bathroom_count' => 101])->toArray()
        )->assertJsonValidationErrors('half_bathroom_count');
    }
}
