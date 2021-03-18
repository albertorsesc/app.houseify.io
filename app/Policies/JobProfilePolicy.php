<?php

namespace App\Policies;

use App\Models\JobProfiles\JobProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User  $user
     * @param JobProfile $jobProfile
     *
     * @return mixed
     */
    public function view(User $user, JobProfile $jobProfile)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param JobProfile $jobProfile
     *
     * @return mixed
     */
    public function update(User $user, JobProfile $jobProfile) : bool
    {
        return (int) $user->id === (int) $jobProfile->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param JobProfile  $jobProfile
     *
     * @return mixed
     */
    public function delete(User $user, JobProfile $jobProfile)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User $user
     * @param  JobProfile  $jobProfile
     *
     * @return mixed
     */
    public function restore(User $user, JobProfile $jobProfile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User $user
     * @param  JobProfile  $jobProfile
     *
     * @return mixed
     */
    public function forceDelete(User $user, JobProfile $jobProfile)
    {
        //
    }
}
