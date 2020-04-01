<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    protected $fillable = ['body', 'user_id', 'reply_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'reply_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
