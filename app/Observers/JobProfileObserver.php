<?php

namespace App\Observers;

use App\Events\Logs\LogActions;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Support\Str;

class JobProfileObserver
{
    /**
     * Handle the property "creating" event.
     *
     * @param JobProfile $jobProfile
     * @return void
     */
    public function creating(JobProfile $jobProfile)
    {
        $jobProfile->uuid = (string) Str::uuid();
        $jobProfile->user_id = auth()->id();
    }

    /**
     * Handle the JobProfile "created" event.
     *
     * @param JobProfile $jobProfile
     *
     * @return void
     */
    public function created(JobProfile $jobProfile)
    {
        LogActions::dispatch('STORE', $jobProfile, auth()->user());
    }

    /**
     * Handle the JobProfile "updated" event.
     *
     * @param JobProfile $jobProfile
     *
     * @return void
     */
    public function updated(JobProfile $jobProfile)
    {
        LogActions::dispatch('UPDATE', $jobProfile, auth()->user());
    }

    public function deleting(JobProfile $jobProfile)
    {
        $jobProfile->location()->delete();
        LogActions::dispatch('DELETE', $jobProfile, auth()->user());
    }

    /**
     * Handle the JobProfile "deleted" event.
     *
     * @param JobProfile  $jobProfile
     *
     * @return void
     */
    public function deleted(JobProfile $jobProfile)
    {
    }

    /**
     * Handle the JobProfile "restored" event.
     *
     * @param  JobProfile  $jobProfile
     *
     * @return void
     */
    public function restored(JobProfile $jobProfile)
    {
        //
    }

    /**
     * Handle the JobProfile "force deleted" event.
     *
     * @param  JobProfile  $jobProfile
     *
     * @return void
     */
    public function forceDeleted(JobProfile $jobProfile)
    {
        //
    }
}
