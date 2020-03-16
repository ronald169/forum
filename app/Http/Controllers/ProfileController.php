<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        return view('profiles.show')
                ->with([
                    'user' => $user,
                    'threads' => $user->threads()->paginate(3),
                    'activities' => Activity::feed($user),
                ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getActivities(User $user): \Illuminate\Database\Eloquent\Collection
    {
        $activities = $user->activities()->latest()->with('subject')->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
        return $activities;
    }

}
