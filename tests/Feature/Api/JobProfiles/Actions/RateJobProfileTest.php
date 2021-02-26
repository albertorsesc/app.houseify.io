<?php

namespace Tests\Feature\Api\JobProfiles\Actions;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RateJobProfileTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.rate';

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_rate_a_job_profile()
    {
        $this->markTestIncomplete();
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->signIn();

        $response = $this->putJson(route($this->routePrefix, $jobProfile));
        dd($response->getOriginalContent());
        $response->assertOk();

        $this->assertDatabaseHas('ratings', [
            'user_id' => auth()->id(),
            'rateable_id' => $jobProfile->id,
            'rateable_type' => class_basename($jobProfile)
        ]);

        $this->assertCount(1, $jobProfile->rating->count());
    }
}
