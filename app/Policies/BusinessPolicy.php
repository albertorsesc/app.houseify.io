<?php

namespace App\Policies;

use App\Models\Businesses\Business;
use App\Models\BusinessesBusiness;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
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
     * @param User $user
     * @param Business $business
     *
     * @return mixed
     */
    public function view(User $user, Business $business)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User  $user
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
     * @param User $user
     * @param Business $business
     *
     * @return mixed
     */
    public function update(User $user, Business $business) : bool
    {
        return (int) $user->id === (int) $business->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  \App\Models\BusinessesBusiness  $businessesBusiness
     *
     * @return mixed
     */
    public function delete(User $user, Business $business)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  \App\Models\BusinessesBusiness  $businessesBusiness
     *
     * @return mixed
     */
    public function restore(User $user, Business $business)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Business $business
     *
     * @return mixed
     */
    public function forceDelete(User $user, Business $business)
    {
        //
    }
}
