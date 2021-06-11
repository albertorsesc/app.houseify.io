<?php

namespace Tests\Feature\Api\JobProfiles;

use App\Models\JobProfiles\JobProfile;
use App\Notifications\NotifyNewJobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class JobProfilesTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['GET' => '/api/job-profiles']
    */
    public function authenticated_user_can_get_all_published_job_profiles()
    {
        $jobProfile = $this->create(JobProfile::class, [], 'published');

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $jobProfile->id,
                    'uuid' => $jobProfile->uuid,
                    'user' => ['id' => $jobProfile->user->id],
                    'title' => $jobProfile->title,
                    'skills' => $jobProfile->skills,
                    'email' => $jobProfile->email,
                    'phone' => $jobProfile->phone,
                    'facebookProfile' => $jobProfile->facebook_profile,
                    'site' => $jobProfile->site,
                    'bio' => $jobProfile->bio,
                    'meta' => [
                        'profile' => $jobProfile->profile()
                    ]
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_store_a_job_profile()
    {
        $jobProfile = $this->make(JobProfile::class);

        $response = $this->postJson(route($this->routePrefix . 'store'), $jobProfile->toArray());
        $response->assertCreated();
        $response->assertJson(['data' => ['title' => $jobProfile->title]]);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/job-profiles/{jobProfile}']
     * @only ['owner']
     */
    public function authenticated_user_can_update_a_job_profile()
    {
        $existingJobProfile = JobProfile::factory()->create();
        $newJobProfileData = $this->make(JobProfile::class);

        $response = $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $newJobProfileData->toArray()
        );
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $existingJobProfile->id,
                'title' => $newJobProfileData['title'],
            ]
        ]);

        $this->assertTrue(auth()->user()->owns($existingJobProfile, 'user_id'));
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['DELETE' => '/api/jobes/{job}']
     * @only ['owner']
     */
    public function authenticated_user_can_delete_a_job_profile()
    {
        $existingJobProfile = JobProfile::factory()->create();

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $existingJobProfile));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('job_profiles', $existingJobProfile->toArray());
    }

    /* Notifications */

    /**
     * @test
     * @throws \Throwable
     */
    public function notification_sent_to_root_users_when_business_is_created()
    {
        Notification::fake();
        $this->signIn([
            'email' => config('houseify.roles.root')[0]
        ]);
        $jobProfile = $this->make(JobProfile::class);

        $response = $this->postJson(route($this->routePrefix . 'store'), $jobProfile->toArray());
        $response->assertCreated();

        $this->assertTrue(in_array(auth()->user()->email, config('houseify.roles.root')));
        $newJobProfile = JobProfile::latest()->first();
        Notification::assertSentTo(
            auth()->user(),
            function (NotifyNewJobProfile $notification, $channels) use ($newJobProfile) {
                return $notification->jobProfile->id === $newJobProfile->id;
            }
        );
    }
}
