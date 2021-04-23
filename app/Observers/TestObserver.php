<?php

namespace App\Observers;

use App\Models\State;

class TestObserver
{
    /**
     * Handle the State "created" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function created(State $state)
    {
        //
    }

    /**
     * Handle the State "updated" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function updated(State $state)
    {
        //
    }

    /**
     * Handle the State "deleted" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function deleted(State $state)
    {
        //
    }

    /**
     * Handle the State "restored" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function restored(State $state)
    {
        //
    }

    /**
     * Handle the State "force deleted" event.
     *
     * @param  \App\Models\State  $state
     * @return void
     */
    public function forceDeleted(State $state)
    {
        //
    }
}
