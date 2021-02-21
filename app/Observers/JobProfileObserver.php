<?php

namespace App\Observers;

use App\Models\JobProfiles\JobProfile;

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
//        $jobProfile->uuid = (string) Str::uuid();
//        $jobProfile->slug = (string) Str::slug($jobProfile->name);
        $jobProfile->user_id = auth()->id();
    }

    /**
     * Handle the JobProfile "created" event.
     *
     * @param  \App\Models\JobProfiles\JobProfile  $jobProfile
     * @return void
     */
    public function created(JobProfile $jobProfile)
    {
        //
    }

    /**
     * Handle the JobProfile "updated" event.
     *
     * @param  \App\Models\JobProfiles\JobProfile  $jobProfile
     * @return void
     */
    public function updated(JobProfile $jobProfile)
    {
        //
    }

    /**
     * Handle the JobProfile "deleted" event.
     *
     * @param  \App\Models\JobProfiles\JobProfile  $jobProfile
     * @return void
     */
    public function deleted(JobProfile $jobProfile)
    {
        //
    }

    /**
     * Handle the JobProfile "restored" event.
     *
     * @param  \App\Models\JobProfiles\JobProfile  $jobProfile
     * @return void
     */
    public function restored(JobProfile $jobProfile)
    {
        //
    }

    /**
     * Handle the JobProfile "force deleted" event.
     *
     * @param  \App\Models\JobProfiles\JobProfile  $jobProfile
     * @return void
     */
    public function forceDeleted(JobProfile $jobProfile)
    {
        //
    }
}
