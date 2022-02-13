<?php

namespace Tests\Feature\Api\Businesses\Inventory;

use Tests\TestCase;
use App\Models\Businesses\Business;
use App\Models\Businesses\Inventory\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.businesses.products.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function business_owner_can_get_all_products_for_its_business()
    {
        $business = $this->create(Business::class);
        $product = $this->create(Product::class, ['business_id' => $business->id]);

        $response = $this->getJson(
            route($this->routePrefix . 'index', $business),
        );
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $product->id,
                    'business' => ['id' => $product->business->id],
                    'name' => $product->name,
                    'inStock' => $product->in_stock,
                    'unitPrice' => $product->unit_price,
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function business_owner_can_store_an_inventory_product_for_its_business()
    {
        $business = $this->create(Business::class);
        $newProduct = $this->make(Product::class);

        $response = $this->postJson(
            route($this->routePrefix . 'store', $business),
            $newProduct->toArray()
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'business' => ['id' => $business->id],
                'name' => $newProduct->name
            ]
        ]);

        $this->assertDatabaseHas(
            'inventory_products',
            array_merge($newProduct->toArray(), ['business_id' => $business->id])
        );
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function business_owner_can_update_an_inventory_product_for_its_business()
    {
        $business = $this->create(Business::class);
        $product = $this->create(Product::class, ['business_id' => $business->id]);
        $newProduct = $this->make(Product::class);

        $response = $this->putJson(
            route($this->routePrefix . 'update', [$business, $product]),
            $newProduct->toArray()
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'business' => ['id' => $business->id],
                'name' => $newProduct->name
            ]
        ]);

        $this->assertDatabaseHas(
            'inventory_products',
            array_merge($newProduct->toArray(), ['business_id' => $business->id])
        );
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function business_owner_can_soft_delete_an_inventory_product_for_its_business()
    {
        $business = $this->create(Business::class);
        $product = $this->create(Product::class, ['business_id' => $business->id]);

        $response = $this->deleteJson(
            route($this->routePrefix . 'destroy', [$business, $product]),
        );
        $response->assertStatus(204);

        $this->assertSoftDeleted(
            'inventory_products',
            ['id' => $product->id]
        );
    }
}
