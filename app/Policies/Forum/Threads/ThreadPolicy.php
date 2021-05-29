<?php

namespace App\Policies\Forum\Threads;

use App\Models\User;
use App\Models\Forum\Threads\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Thread $thread
     * @return mixed
     */
    public function view(User $user, Thread $thread)
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
     * @param  User  $user
     * @param Thread $thread
     *
     * @return mixed
     */
    public function update(User $user, Thread $thread)
    {
        return (int) $thread->author_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param Thread $thread
     *
     * @return mixed
     */
    public function delete(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param Thread $thread
     *
     * @return mixed
     */
    public function restore(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param Thread $thread
     *
     * @return mixed
     */
    public function forceDelete(User $user, Thread $thread)
    {
        //
    }
}
