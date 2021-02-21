<?php

namespace Tests\Feature\Api\JobProfiles;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobProfilesTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['GET' => '/api/job-profiles']
    */
    public function authenticated_user_can_get_all_published_job_profiles()
    {
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class, [], 'published');

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $jobProfile->id,
                    'user' => ['id' => $jobProfile->user->id],
                    'title' => $jobProfile->title,
                    'birthdateAt' => $jobProfile->birthdate_at,
                    'skills' => $jobProfile->skills,
                    'email' => $jobProfile->email,
                    'phone' => $jobProfile->phone,
                    'facebookProfile' => $jobProfile->facebook_profile,
                    'site' => $jobProfile->site,
                    'bio' => $jobProfile->bio
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
        $this->signIn();

        $jobProfile = $this->make(JobProfile::class);

        $response = $this->postJson(route($this->routePrefix . 'store'), $jobProfile->toArray());
        $response->assertCreated();
        $response->assertJson(['data' => ['title' => $jobProfile->title]]);

        $this->assertDatabaseHas(
            'job_profiles',
            array_merge($jobProfile->toArray(), [
                'skills' => collect($jobProfile->skills)->toJson()
            ])
        );
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/job-profiles/{jobProfile}']
     * @only ['owner']
     */
    public function authenticated_user_can_update_a_job_profile()
    {
        $this->signIn();

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

        $this->assertDatabaseHas(
            'job_profiles',
            array_merge($newJobProfileData->toArray(), [
                'skills' => collect($newJobProfileData['skills'])->toJson()
            ])
        );
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
        $this->signIn();

        $existingJobProfile = JobProfile::factory()->create();

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $existingJobProfile));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('job_profiles', $existingJobProfile->toArray());
    }


}
