<?php

namespace App\Models;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{

    use Favoritable;

    protected $appends = ['favoritesCount', 'isFavorited', 'commentsCount'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($course) {
            $course->update(['slug' => $course->title]);
            $course->klasse->increment('courses_count');
        });

        static::deleting(function ($course) {
            $course->comments->each->delete();
        });
    }

    protected $fillable = ['title', 'betreuung', 'description', 'body', 'slug', 'betreuung_id', 'class', 'matiere', 'user_id', 'lesson'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function path()
    {
        return "/courses/{$this->klasse->slug}/{$this->slug}";
    }

    public function klasse()
    {
        return $this->belongsTo('App\Models\Betreuung', 'betreuung_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-". $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function comments()
    {
        return $this->morphMany('App\models\Comment', 'commentable')->whereNull('reply_id');
    }

    public function exercises()
    {
        return $this->hasMany('App\Models\Exercise');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\ThreadSubscription');
    }

    public function addExercise($data)
    {
//        if ($this->locked) {
//            throw new \Exception('Thread is locked');
//        }

        $exercise =  $this->exercises()->create($data);

//        event(new ThreadReceivedNewReply($reply));

        $this->notifySubscribers($exercise);

        return $exercise;
    }

    public function notifySubscribers($exercise)
    {
        $this->subscriptions
            ->where('user_id', '!=', $exercise->user_id)
            ->each
            ->notify($exercise);

    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' =>  $userId ?: auth()->id(),
        ]);
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()->where(['user_id' =>  $userId ?: auth()->id()])->delete();
    }

    public function getIsSubscribeToAttribute()
    {
        return !! $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments->count();
    }
}
