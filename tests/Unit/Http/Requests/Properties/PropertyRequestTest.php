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
        $validatedField = 'price';
        $brokenRule = 'non-integer';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $property = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $property),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
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

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_have_a_valid_format()
    {
        $validatedField = 'email';
        $brokenRule = 'not-an-email';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_not_exceed_150_characters()
    {
        $validatedField = 'email';
        $brokenRule = Str::random(141) . '@email.com';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_be_required_if_phone_is_empty()
    {
        $validatedField = 'email';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [
                $validatedField => $brokenRule,
                'phone' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingProperty = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $this->make(Property::class, [
                $validatedField => $brokenRule,
                'phone' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function phone_must_be_required_if_email_is_empty()
    {
        $validatedField = 'phone';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [
                $validatedField => $brokenRule,
                'email' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingProperty = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $this->make(Property::class, [
                $validatedField => $brokenRule,
                'email' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function phone_must_not_exceed_50_characters()
    {
        $validatedField = 'phone';
        $brokenRule = Str::random(51);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Property::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Property::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
