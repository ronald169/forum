<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['avatar'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function threads()
    {
        return $this->hasMany('App\Models\Thread');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);

    }

    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread),
                now()
            );
    }

    public function lastReply()
    {
        return $this->hasOne('App\Models\Reply')->latest();
    }

    public function getAvatarAttribute()
    {
        if (! $this->avatar_path) {
            return '/storage/avatars/default.jpeg';
        }
        return $this->avatar_path;
    }

    public function setAvatarPathAttribute($body)
    {
        $this->attributes['avatar_path'] =  '/storage/' .$body;
    }

    public function isAdmin()
    {
        return in_array($this->name, ['JohnDoe',  'Hosea Rempel']);
    }
}
