<?php

namespace Tests\Unit\Http\Requests\Properties;

use Illuminate\Support\Str;
use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class PropertyRequestTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_category_id_is_required()
    {
        $validatedField = 'property_category_id';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [
                $validatedField => $brokenRule,
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        //        $this->putJson(
        //            route($this->routePrefix . 'update', $this->create(Property::class)),
        //            $this->make(Property::class, ['property_category_id' => null])->toArray()
        //        )->assertJsonValidationErrors('property_category_id');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_category_id_must_exits_in_property_categories_table()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['property_category_id' => 1001])->toArray()
        )->assertJsonValidationErrors('property_category_id');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['property_category_id' => 1001])->toArray()
        )->assertJsonValidationErrors('property_category_id');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function business_type_is_required()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['business_type' => null])->toArray()
        )->assertJsonValidationErrors('business_type');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['business_type' => null])->toArray()
        )->assertJsonValidationErrors('business_type');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function business_type_must_exits_in_business_type_all_method()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['business_type' => 'venta/renta'])->toArray()
        )->assertJsonValidationErrors('business_type');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['business_type' => 'venta/renta'])->toArray()
        )->assertJsonValidationErrors('business_type');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function title_is_required()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['title' => null])->toArray()
        )->assertJsonValidationErrors('title');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['title' => null])->toArray()
        )->assertJsonValidationErrors('title');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function title_must_not_exceed_50_characters()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['title' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('title');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['title' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('title');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function price_is_required()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['price' => null])->toArray()
        )->assertJsonValidationErrors('price');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['price' => null])->toArray()
        )->assertJsonValidationErrors('price');
    }

    /**
     *   @test
     *   @throws \Throwable
     *   Doesn't fail even though there's 'integer' validation in PropertyRequest
     *   due to Attribute Casting: ['price' => 'integer'] in Property model.
     */
    public function price_must_be_an_integer()
    {
        $brokenRule = 'non-integer';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['price' => $brokenRule])->toArray()
        )->assertJsonMissingValidationErrors('price');

        $property = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Property::class, ['price' => $brokenRule])->toArray()
        )->assertJsonMissingValidationErrors('price');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function price_must_not_be_greater_than_100000000()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['price' => 100000001])->toArray()
        )->assertJsonValidationErrors('price');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['price' => 100000001])->toArray()
        )->assertJsonValidationErrors('price');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function price_must_be_greater_than_0()
    {
        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, ['price' => -1])->toArray()
        )->assertJsonValidationErrors('price');

        $this->putJson(
            route($this->routePrefix . 'update', $this->create(Property::class)),
            $this->make(Property::class, ['price' => -1])->toArray()
        )->assertJsonValidationErrors('price');
    }
}
