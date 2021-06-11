<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\JobProfiles\JobProfile;
use App\Notifications\NotifyNewJobProfile;
use Illuminate\Support\Facades\Notification;

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
        $rootUsers = User::query()
                         ->whereIn('email', config('houseify.roles.root'))
                         ->get();
        Notification::send($rootUsers, new NotifyNewJobProfile($jobProfile));
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
