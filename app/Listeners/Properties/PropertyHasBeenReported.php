<?php

namespace App\Listeners\Properties;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Properties\PropertyHasBeenReported as PropertyHasBeenReportedNotification;

class PropertyHasBeenReported implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(object $event)
    {
        $property = $event->report->reportable;

        $property->unpublish();

        $property->seller->notify(
            new PropertyHasBeenReportedNotification($event->report)
        );
    }
}
