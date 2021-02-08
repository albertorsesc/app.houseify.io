<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\PropertyFeature;

class PropertyFeaturesTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.features.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    public function authenticated_users_can_get_all_property_features()
    {
        $propertyFeature = $this->create(PropertyFeature::class);

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'property' => [
                        'id' => $propertyFeature->property->id,
                    ],
                    'features' => [
                        'property_size' => $propertyFeature->features['property_size'],
                        'construction_size' => $propertyFeature->features['construction_size'],
                        'level_count' => $propertyFeature->features['level_count'],
                        'room_count' => $propertyFeature->features['room_count'],
                        'bathroom_count' => $propertyFeature->features['bathroom_count'],
                        'half_bathroom_count' => $propertyFeature->features['half_bathroom_count'],
                    ]
                ]
            ]
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *   @endpoint ['POST', '/api/property-features']
     */
    public function authenticated_users_can_store_a_property_feature()
    {
        $propertyFeature = $this->make(PropertyFeature::class);

        $response = $this->postJson(
            route($this->routePrefix . 'store', $propertyFeature->property),
            $propertyFeature->toArray()
        );
        $response->assertStatus(201);

        $this->assertEquals(PropertyFeature::first()->features, $propertyFeature->features);
        $this->assertEquals(PropertyFeature::first()->property->id, $propertyFeature->property_id);
    }

    public function authenticated_users_can_get_a_property_feature()
    {
        $propertyFeature = $this->create(PropertyFeature::class);

        $response = $this->getJson(route($this->routePrefix . 'show', $propertyFeature));
        $response->assertOk();
        $response->assertJson(['data' => ['id' => $propertyFeature->id]]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/property-features/{propertyFeature}']
     */
    public function authenticated_users_can_update_a_property_feature()
    {
        $propertyFeature = $this->create(PropertyFeature::class);
        $propertyFeatureData = $this->make(PropertyFeature::class, ['property_id' => $propertyFeature->property_id]);

        $response = $this->putJson(
            route($this->routePrefix . 'update', $propertyFeature->property),
            $propertyFeatureData->toArray()
        );
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $propertyFeature->id,
                'features' => ['property_size' => $propertyFeatureData->features['property_size']]
            ]
        ]);

        $this->assertDatabaseHas('property_features', [
            'property_id' => $propertyFeature->property->id,
            'features' => json_encode($propertyFeatureData->features)
        ]);
    }

    public function authenticated_users_can_delete_a_property_feature()
    {
        $propertyFeature = $this->create(PropertyFeature::class);

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $propertyFeature));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('property_features', [
            'property_id' => $propertyFeature->property->id,
            'features' => json_encode($propertyFeature->features)
        ]);
    }
}
