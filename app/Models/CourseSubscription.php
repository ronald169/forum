<?php

namespace App\Models;

use App\Notifications\CourseWasUpdated;
use Illuminate\Database\Eloquent\Model;

class CourseSubscription extends Model
{


    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function notify($reply)
    {
        $this->user->notify(new CourseWasUpdated($this->thread, $reply));
    }

}
