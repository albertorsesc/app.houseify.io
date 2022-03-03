<?php

namespace Tests\Feature\Api\Businesses\Inventory;

use Illuminate\Support\Facades\Event;
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
                    'description' => $product->description,
                    'inStock' => $product->in_stock,
                    'storageUnit' => $product->storage_unit,
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
            array_merge($newProduct->toArray(), [
                'business_id' => $business->id,
                'unit_price' => $newProduct->unit_price * 100
            ])
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
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'business' => ['id' => $business->id],
                'name' => $newProduct->name
            ]
        ]);

        $this->assertDatabaseHas(
            'inventory_products',
            array_merge($newProduct->toArray(), [
                'business_id' => $business->id,
                'unit_price' => $newProduct->unit_price * 100
            ])
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

    /* Unhappy path */

    /**
     * @test
     * @throws \Throwable
     */
    public function not_owner_of_business_cannot_store_an_inventory_product_for_a_non_owned_business()
    {
        Event::fake();
        $business = $this->create(Business::class);
        $newProduct = $this->make(Product::class);

        $this->signIn();
        $this->postJson(
            route($this->routePrefix . 'store', $business),
            $newProduct->toArray()
        )->assertForbidden();
    }
}
