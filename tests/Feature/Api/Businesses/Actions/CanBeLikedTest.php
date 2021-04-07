<?php

namespace Tests\Feature\Api\Businesses\Actions;

use Tests\BusinessTestCase;
use App\Models\Businesses\Business;

class CanBeLikedTest extends BusinessTestCase
{
    private string $routePrefix = 'api.businesses.likes.';

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
    */
    public function business_can_be_liked()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $response = $this->postJson(route($this->routePrefix . 'store', $business));
        $response->assertOk();

        $this->assertCount(1, $business->fresh()->likes);
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
    */
    public function business_cannot_be_liked_twice_by_same_user_and_will_remove_current_like()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $business->liked();
        $this->assertCount(1, $business->fresh()->likes);

        $business->liked();
        $this->assertCount(0, $business->fresh()->likes);

        $business->liked();
        $this->assertCount(1, $business->fresh()->likes);
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function business_can_disliked()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $business));
        $response->assertOk();

        $this->assertCount(1, $business->fresh()->likes()->where('liked', false)->get());

    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function business_cannot_be_disliked_twice_and_will_remove_current_dislike()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $business->disliked();
        $this->assertCount(1, $business->fresh()->likes()->where('liked', false)->get());

        $business->disliked();
        $this->assertCount(0, $business->fresh()->likes()->where('liked', false)->get());
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
    */
    public function one_like_removes_a_dislike_and_vice_versa()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->signIn();

        $business->liked();
        $this->assertCount(1, $business->fresh()->likes()->where('liked', true)->get());

        $business->disliked();
        $this->assertCount(1, $business->fresh()->likes()->where('liked', false)->get());

        $business->liked();
        $this->assertCount(1, $business->fresh()->likes()->where('liked', true)->get());

        $business->disliked();
        $this->assertCount(1, $business->fresh()->likes()->where('liked', false)->get());

        $business->disliked();
        $this->assertCount(0, $business->fresh()->likes);
    }
}
