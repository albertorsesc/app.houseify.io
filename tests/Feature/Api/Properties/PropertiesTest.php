<?php

namespace Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertiesTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['GET', '/api/properties']
     * @only ['authenticated']
     */
    public function authenticated_user_can_get_all_properties()
    {
        $property = $this->create(Property::class);

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $property->id,
                    'propertyCategory' => ['id' => $property->propertyCategory->id],
                    'businessType' => $property->business_type,
                    'title' => $property->title,
                    'slug' => $property->slug,
                    'price' => $property->price,
                    'formattedPrice' => $property->formattedPrice(),
                    'comments' => $property->comments,
                    'status' => $property->status,
                    'meta' => [
                        'links' => [
                            'profile' => $property->profile(),
                        ],
                        'updatedAt' => $property->updated_at->diffForHumans()
                    ]
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['POST', '/api/properties']
     * @only ['authenticated']
     */
    public function authenticated_user_can_store_a_property()
    {
        $property = $this->makeProperty();

        $response = $this->postJson(route($this->routePrefix . 'store'), $property);
        $response->assertStatus(201);
        $response->assertJson(['data' => ['title' => $property['title']]]);

        $this->assertDatabaseHas('properties', $property);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT', '/api/properties/{property}']
     * @only ['owner', 'root']
     */
    public function authorized_user_can_update_a_property()
    {
        $property = $this->create(Property::class);
        $propertyData = $this->makeProperty();

        $response = $this->putJson(
            route($this->routePrefix . 'update', $property),
            $propertyData
        );
        $response->assertJson([
            'data' => [
                'id' => $property->id,
                'title' => $propertyData['title']
            ]
        ]);

        $this->assertDatabaseHas(
            'properties',
            $propertyData
        );
    }

    /**
     *   @test
     *   @throws \Throwable
     *   @endpoint ['DELETE', 'api/properties/{property}']
     *  @only ['owner', 'root']
     */
    public function authorized_user_can_delete_a_property()
    {
        $this->signIn();

        $property = $this->create(Property::class, [
            'seller_id' => auth()->id()
        ]);

        $this->deleteJson(route($this->routePrefix . 'destroy', $property));

        $this->assertDatabaseMissing(
            'properties',
            $property->toArray()
        );
    }
}
