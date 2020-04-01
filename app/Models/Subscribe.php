<?php

namespace App\Models;

use App\Notifications\CourseCreated;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['user_id', 'subscribable_id'];

    public function subscribable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function notifyCourseCreated($course)
    {
        $this->user->notify(new CourseCreated($course));
    }

}
