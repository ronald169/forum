<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function thread()
    {
        return $this->belongsTo('App\Models\Thread');
    }

    public function notify($reply)
    {
        $this->user->notify(new ThreadWasUpdated($this->thread, $reply));
    }
}
