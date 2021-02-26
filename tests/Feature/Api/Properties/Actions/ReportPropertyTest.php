<?php

namespace Tests\Feature\Api\Properties\Actions;

use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class ReportPropertyTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.';

    /**
     * @test
     * @throws \Throwable
    */
    public function guest_cannot_report_a_property()
    {
        $this->signIn();
        $property = $this->create(Property::class);
        $this->signOut();

        $this->assertCount(0, $property->reports);

        $this->postJson(route($this->routePrefix . 'report', $property), [
            'reporting_cause' => $property->getReportingCauses()['offensive'],
            'comments' => 'Some comments...'
        ])->assertUnauthorized();

        $this->assertCount(0, $property->fresh()->reports);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/properties/{property}/report']
     */
    public function authenticated_user_can_report_a_property()
    {
        $this->signIn();

        $property = $this->create(Property::class);
        $reportingCause = $property->getReportingCauses()['offensive'];

        $this->assertCount(0, $property->reports);

        $this->postJson(route($this->routePrefix . 'report', $property), [
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);

        $this->assertCount(1, $property->fresh()->reports);

        $this->assertDatabaseHas('reports', [
            'user_id' => auth()->id(),
            'reportable_id' => $property->id,
            'reportable_type' => get_class($property),
            'reporting_cause' => $reportingCause,
            'comments' => 'Some comments...'
        ]);
    }
}
