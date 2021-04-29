<?php

namespace App\Listeners\Reports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Reports\NewReportSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Reports\ModelHasBeenReported as ModelHasBeenReportedListener;

class ModelHasBeenReported implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  NewReportSubmitted  $event
     * @return void
     */
    public function handle(NewReportSubmitted $event)
    {
        $fk_relation = [
            'Business' => 'owner',
            'Property' => 'seller',
            'JobProfile' => 'user',
        ];

        $model = $event->report->reportable;

        $model->unpublish();

        $relation = $fk_relation[class_basename($model)];

        $model->$relation->notify(
            new ModelHasBeenReportedListener($event->report, $relation)
        );
    }
}
