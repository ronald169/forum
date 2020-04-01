<?php

namespace App\Policies;

use App\Models\Event;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Event $event)
    {
        return $user->id === $event->user_id;
    }
}
