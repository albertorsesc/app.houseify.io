<?php

namespace Tests\Unit\Http\Requests\Businesses;

use App\Models\Businesses\Business;
use App\Models\Businesses\Inventory\Product;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductRequestTest extends TestCase
{
    use RefreshDatabase;

    private Business $business;

    private string $routePrefix = 'api.businesses.products.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
        $this->business = $this->create(Business::class);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function name_is_required()
    {
        $validatedField = 'name';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function name_must_not_exceed_255_characters()
    {
        $validatedField = 'name';
        $brokenRule = Str::random(256);

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function in_stock_must_be_an_integer()
    {
        $validatedField = 'in_stock';
        $brokenRule = 'not-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function storage_unit_must_exist_in_houseify_config_file_storage_units_key()
    {
        $validatedField = 'storage_unit';
        $brokenRule = 'invalid-unit';

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function storage_unit_is_required_if_in_stock_is_greater_than_zero()
    {
        $validatedField = 'storage_unit';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [
                $validatedField => $brokenRule,
                'in_stock' => 1
            ]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [
                $validatedField => $brokenRule,
                'in_stock' => 1
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function unit_price_must_be_numeric()
    {
        $validatedField = 'unit_price';
        $brokenRule = 'non-numeric';

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $product = $this->create(Product::class, ['business_id' => $this->business->id]);
        $this->putJson(
            route($this->routePrefix . 'update', [$this->business, $product]),
            $this->make(Product::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
