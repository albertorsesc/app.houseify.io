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
        $jobProfile->searchable();
    }

    public function deleting(JobProfile $jobProfile)
    {
        $jobProfile->location()->delete();
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
