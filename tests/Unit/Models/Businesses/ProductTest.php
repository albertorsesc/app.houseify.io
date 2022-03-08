<?php

namespace Tests\Unit\Models\Businesses;

use Tests\TestCase;
use App\Models\Businesses\Business;
use App\Models\Businesses\Inventory\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function product_belongs_to_a_business()
    {
        $this->fakeEvent();
        $product = $this->create(Product::class);

        $this->assertInstanceOf(Business::class, $product->business);
    }
}
