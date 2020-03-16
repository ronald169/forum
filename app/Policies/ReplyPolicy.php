<?php

namespace App\Policies;

use App\Models\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Reply $reply)
    {
        //
    }

    public function create(User $user)
    {
        $lastReply = $user->fresh()->lastReply;

        return ! $lastReply || ! $lastReply->wasJustPublished();

//        if (! $lastReply) return true;
//
//        return ! $lastReply->wasJustPublished();
    }

    public function update(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Reply  $reply
     * @return mixed
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }

    /**
     * Determine whether the user can restore the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Reply  $reply
     * @return mixed
     */
    public function restore(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Reply  $reply
     * @return mixed
     */
    public function forceDelete(User $user, Reply $reply)
    {
        //
    }
}
