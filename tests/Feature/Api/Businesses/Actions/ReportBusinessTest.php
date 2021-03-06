<?php

namespace Tests\Feature\Api\Businesses\Actions;

use Tests\BusinessTestCase;
use App\Models\Businesses\Business;

class ReportBusinessTest extends BusinessTestCase
{
    private string $routePrefix = 'api.businesses.';

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_cannot_report_a_business()
    {
        $this->signIn();
        $business = $this->create(Business::class);
        $this->signOut();

        $this->assertCount(0, $business->reports);

        $this->postJson(route($this->routePrefix . 'report', $business), [
            'reporting_cause' => $business->getReportingCauses()['offensive'],
            'comments' => 'Some comments...'
        ])->assertUnauthorized();

        $this->assertCount(0, $business->fresh()->reports);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/businesses/{business}/report']
     */
    public function authenticated_user_can_report_a_business()
    {
        $this->signIn();

        $business = $this->create(Business::class);
        $reportingCause = Business::getReportingCauses()['offensive'];

        $this->assertCount(0, $business->reports);

        $this->postJson(route($this->routePrefix . 'report', $business), [
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);

        $this->assertCount(1, $business->fresh()->reports);

        $this->assertDatabaseHas('reports', [
            'user_id' => auth()->id(),
            'reportable_id' => $business->id,
            'reportable_type' => get_class($business),
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);
    }
}
