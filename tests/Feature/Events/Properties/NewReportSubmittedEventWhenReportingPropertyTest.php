<?php

namespace Tests\Feature\Events\Properties;

use Tests\PropertyTestCase;
use Illuminate\Support\Str;
use App\Models\Properties\Property;
use App\Events\Reports\NewReportSubmitted;
use App\Notifications\Properties\PropertyHasBeenReported;

class NewReportSubmittedEventWhenReportingPropertyTest extends PropertyTestCase
{
    /**
     * @test
     * @throws \Throwable
    */
    public function new_report_submitted_event_is_dispatched_when_report_has_been_submitted()
    {
        $this->fakeEvent(NewReportSubmitted::class);

        $this->signIn();
        $property = $this->create(Property::class);
        $this->signOut();

        $this->signIn();

        $property->report([
            'reporting_cause' => collect(Property::getReportingCauses())->random(1),
            'comments' => Str::random(100)
        ]);

        $this->assertCount(1, $property->reports);

        \Event::assertDispatched(NewReportSubmitted::class);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function property_has_been_reported_notification_sent_when_new_report_submitted_is_dispatched()
    {
        \Notification::fake();

        $this->signIn();
        $property = $this->create(Property::class);
        $this->signOut();

        $this->signIn();

        $property->report([
            'reporting_cause' => collect(Property::getReportingCauses())->random(1),
            'comments' => Str::random(100)
        ]);

        $report = $property->reports->last();

        \Notification::assertSentTo(
            $property->seller,
            PropertyHasBeenReported::class,
            function ($notification, $channels) use ($report, $property) {
                return $notification->report->id === $report->id &&
                    $notification->report->reportable->id === $property->id;
            }
        );
    }
}
