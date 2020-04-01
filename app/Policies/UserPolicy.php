<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, User $auth)
    {
        return $user->id === $auth->id;
    }

    public function show(User $user, User $auth)
    {
        return $user->id === $auth->id;
    }
}
