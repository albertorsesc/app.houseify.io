<?php

namespace Tests\Feature\Api\Businesses;

use Illuminate\Support\Arr;
use Tests\BusinessTestCase;
use Illuminate\Support\Str;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessesTest extends BusinessTestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.businesses.';

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['GET' => '/api/businesses']
     * @only ['authenticated']
     */
    public function authenticated_user_can_get_all_businesses()
    {
        $this->signIn();

        $business = Business::factory()->create();

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $business->id,
                    'uuid' => $business->uuid,
                    'name' => $business->name,
                    'slug' => Str::slug($business->name),
                    'owner' => ['id' => $business->owner->id],
                    'categories' => $business->categories,
                    'email' => $business->email,
                    'phone' => $business->phone,
                    'facebookProfile' => $business->facebook_profile,
                    'linkedinProfile' => $business->linkedin_profile,
                    'site' => $business->site,
                    'comments' => $business->comments,
                    'status' => $business->status,
                    'logo' => $business->logo,
                    'meta' => [
                        'profile' => $business->profile(),
                        'updatedAt' => $business->updated_at->diffForHumans()
                    ]
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['POST' => '/api/businesses']
     * @only ['authenticated']
     */
    public function authenticated_user_can_store_a_business()
    {
        $this->signIn();

        $newBusiness = $this->makeBusiness();

        $response = $this->postJson(
            route($this->routePrefix . 'store'),
            $newBusiness
        );
        $response->assertCreated();
        $response->assertJson(['data' => ['name' => $newBusiness['name']]]);

        $business = Business::first();
        $this->assertEquals($business->categories, $newBusiness['categories']);
        $this->assertTrue($business->owner->id === auth()->id());
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/businesses/{business}']
     * @only ['owner']
     */
    public function authenticated_user_can_update_a_business()
    {
        $this->signIn();

        $existingBusiness = Business::factory()->create();
        $newBusinessData = $this->makeBusiness();

        $response = $this->putJson(
            route($this->routePrefix . 'update', $existingBusiness),
            $newBusinessData
        );
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $existingBusiness->id,
                'name' => $newBusinessData['name'],
            ]
        ]);

        $this->assertEquals(
            $existingBusiness->fresh()->categories,
            $newBusinessData['categories']
        );
        $this->assertTrue(
            auth()->user()->owns($existingBusiness, 'owner_id')
        );
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['DELETE' => '/api/businesses/{business}']
     * @only ['owner']
     */
    public function authenticated_user_can_delete_a_business()
    {
        $this->signIn();

        $existingBusiness = Business::factory()->create();

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $existingBusiness));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('businesses', $existingBusiness->toArray());
    }
}
