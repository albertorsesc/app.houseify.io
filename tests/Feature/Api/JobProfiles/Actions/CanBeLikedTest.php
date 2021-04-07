<?php

namespace Tests\Feature\Api\JobProfiles\Actions;

use Tests\JobProfileTestCase;
use App\Models\JobProfiles\JobProfile;

class CanBeLikedTest extends JobProfileTestCase
{
    private string $routePrefix = 'api.job-profiles.likes.';

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function job_profile_can_be_liked()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $response = $this->postJson(route($this->routePrefix . 'store', $jobProfile));
        $response->assertOk();

        $this->assertCount(1, $jobProfile->fresh()->likes);
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function job_profile_cannot_be_liked_twice_by_same_user_and_will_remove_current_like()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $jobProfile->liked();
        $this->assertCount(1, $jobProfile->fresh()->likes);

        $jobProfile->liked();
        $this->assertCount(0, $jobProfile->fresh()->likes);

        $jobProfile->liked();
        $this->assertCount(1, $jobProfile->fresh()->likes);
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function job_profile_can_disliked()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $jobProfile));
        $response->assertOk();

        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', false)->get());

    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function job_profile_cannot_be_disliked_twice_and_will_remove_current_dislike()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $jobProfile->disliked();
        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', false)->get());

        $jobProfile->disliked();
        $this->assertCount(0, $jobProfile->fresh()->likes()->where('liked', false)->get());
    }

    /**
     * @test
     * @throws \Throwable
     * @only ['auth']
     */
    public function one_like_removes_a_dislike_and_vice_versa()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $jobProfile->liked();
        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', true)->get());

        $jobProfile->disliked();
        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', false)->get());

        $jobProfile->liked();
        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', true)->get());

        $jobProfile->disliked();
        $this->assertCount(1, $jobProfile->fresh()->likes()->where('liked', false)->get());

        $jobProfile->disliked();
        $this->assertCount(0, $jobProfile->fresh()->likes);
    }
}
