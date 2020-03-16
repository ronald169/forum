<?php

namespace App\Policies;

use App\Models\Thread;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{

//    public function before($user)
//    {
//        if ($user->name == 'Mell Trust') return true;
//    }

    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Thread $thread)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Thread  $thread
     * @return mixed
     */
    public function update(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id;
    }

    /**
     * Determine whether the user can delete the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Thread  $thread
     * @return mixed
     */
    public function delete(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id;
    }

    /**
     * Determine whether the user can restore the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Thread  $thread
     * @return mixed
     */
    public function restore(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Thread  $thread
     * @return mixed
     */
    public function forceDelete(User $user, Thread $thread)
    {
        //
    }
}
