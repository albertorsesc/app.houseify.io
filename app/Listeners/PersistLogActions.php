<?php

namespace App\Listeners;

use App\Models\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PersistLogActions implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        Log::toLog(
            $event->action,
            $event->model,
            $event->responsible,
            $event->additionalInfo,
            $event->logType
        );
    }
}
