<?php

namespace Tests\Feature\Api\JobProfiles\Actions;

use App\Models\Businesses\Business;
use Tests\TestCase;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportJobProfileTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_cannot_report_a_job_profile()
    {
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->signOut();

        $this->assertCount(0, $jobProfile->reports);

        $this->postJson(route($this->routePrefix . 'report', $jobProfile), [
            'reporting_cause' => JobProfile::getReportingCauses()['offensive'],
            'comments' => 'Some comments...'
        ])->assertUnauthorized();

        $this->assertCount(0, $jobProfile->fresh()->reports);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/job-profiles/{jobProfile:slug}/report']
     */
    public function authenticated_user_can_report_a_job_profile()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class);
        $reportingCause = JobProfile::getReportingCauses()['offensive'];

        $this->assertCount(0, $jobProfile->reports);

        $this->postJson(route($this->routePrefix . 'report', $jobProfile), [
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);

        $this->assertCount(1, $jobProfile->fresh()->reports);

        $this->assertDatabaseHas('reports', [
            'user_id' => auth()->id(),
            'reportable_id' => $jobProfile->id,
            'reportable_type' => get_class($jobProfile),
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);
    }
}
