<?php

namespace Tests\Feature\Api\JobProfiles\Actions;

use App\Models\JobProfiles\JobProfile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToggleStatusTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/businesses/{business}/toggle']
     */
    public function authorized_user_can_toggle_published_and_unpublished_a_job_profile()
    {
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class, ['status' => false]);
        $this->assertFalse($jobProfile->status);

        $this->putJson(route($this->routePrefix . 'toggle', $jobProfile));
        $this->assertTrue($jobProfile->fresh()->status);

        $this->putJson(route($this->routePrefix . 'toggle',  $jobProfile));
        $this->assertFalse($jobProfile->fresh()->status);
    }
}
