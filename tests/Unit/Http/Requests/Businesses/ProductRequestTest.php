<?php

namespace Tests\Unit\Http\Requests\Businesses;

use App\Models\Businesses\Business;
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
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function unit_price_must_be_an_integer()
    {
        $validatedField = 'unit_price';
        $brokenRule = 'not-integer';

        $this->postJson(
            route($this->routePrefix . 'store', $this->business),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);
    }
}
