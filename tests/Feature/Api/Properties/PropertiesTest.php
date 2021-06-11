<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use App\Notifications\NotifyNewProperty;
use Illuminate\Support\Facades\Notification;
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
                    'phone' => $property->phone,
                    'email' => $property->email,
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
        $response->assertCreated();
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

    /* Notifications */

    /**
     * @test
     * @throws \Throwable
    */
    public function notification_sent_to_root_users_when_property_is_created()
    {
        Notification::fake();
        $this->signIn([
            'email' => config('houseify.roles.root')[0]
        ]);
        $property = $this->makeProperty();

        $response = $this->postJson(route($this->routePrefix . 'store'), $property);
        $response->assertCreated();

        $this->assertTrue(in_array(auth()->user()->email, config('houseify.roles.root')));
        $newProperty = Property::latest()->first();
        Notification::assertSentTo(
            auth()->user(),
            function (NotifyNewProperty $notification, $channels) use ($newProperty) {
                return $notification->property->id === $newProperty->id;
            }
        );
    }
}
