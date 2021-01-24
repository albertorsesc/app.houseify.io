<?php

namespace App\Policies;

use App\Models\Properties\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
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
     * @param Property $property
     * @return mixed
     */
    public function view(User $user, Property $property) {}

    public function create(User $user) {}

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param Property $property
     * @return mixed
     */
    public function update(User $user, Property $property) : bool
    {
        return (int) $user->id === (int) $property->seller_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param Property $property
     *
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Properties\Property  $property
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Properties\Property  $property
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        //
    }
}
