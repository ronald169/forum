<?php

namespace App\Policies;

use App\Models\Betreuung;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BetreuungPolicy
{
    use HandlesAuthorization;


    public function destroy(User $user, Betreuung $klass)
    {
        return $user->id === $klass->user_id;
    }

    public function update(User $user, Betreuung $klass)
    {
        return $user->id === $klass->user_id;
    }

    public function create(User $user, Betreuung $klass)
    {
        return $user->id === $klass->user_id;
    }
}
