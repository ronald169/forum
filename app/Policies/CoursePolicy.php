<?php

namespace App\Policies;

use App\Models\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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

    public function comment(User $user, Course $course)
    {
        //
    }

    public function update(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }

    public function delete(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
}
