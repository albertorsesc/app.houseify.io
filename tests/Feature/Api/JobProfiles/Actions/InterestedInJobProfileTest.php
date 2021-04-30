<?php

namespace Tests\Feature\Api\JobProfiles\Actions;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InterestedInJobProfileTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

    protected function setUp () : void
    {
        parent::setUp();
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/job-profiles/{jobProfile}/interested']
     */
    public function guests_cannot_interest_a_job_profile()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();
        $this->assertEquals(0, $jobProfile->interests->count());

        $this->postJson(
            route($this->routePrefix . 'interested', $jobProfile)
        )->assertUnauthorized();

        $this->assertCount(0, $jobProfile->fresh()->interests);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/job-profiles/{jobProfile}/interested']
     */
    public function authenticated_user_can_be_interested_in_a_job_profile()
    {
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class);
        $this->assertCount(0, $jobProfile->interests);

        $this->postJson(route($this->routePrefix . 'interested', $jobProfile->uuid));

        $this->assertCount(1, $jobProfile->fresh()->interests);

        $this->assertDatabaseHas('interests', [
            'interested_by' => auth()->id(),
            'interestable_id' => $jobProfile->id,
            'interestable_type' => get_class($jobProfile)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/job-profiles/{job_profile}/uninterested']
     */
    public function authenticated_user_can_be_uninterested_in_a_job_profile()
    {
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class);
        $this->assertCount(0, $jobProfile->interests);

        $jobProfile->interested();
        $this->assertCount(1, $jobProfile->fresh()->interests);

        $this->deleteJson(route($this->routePrefix . 'uninterested', $jobProfile));
        $this->assertCount(0, $jobProfile->fresh()->interests);

        $this->assertDatabaseMissing('interests', [
            'interested_by' => auth()->id(),
            'interestable_id' => $jobProfile->id,
            'interestable_type' => get_class($jobProfile)
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_only_be_interested_in_a_job_profile_once()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);

        $jobProfile->interested();
        $jobProfile->interested();

        $this->assertCount(1, $jobProfile->fresh()->interests);
    }
}
