<?php


namespace App\Traits;


use App\Notifications\CourseCreated;

trait Subscribable
{

    protected static function bootSubscribable()
    {
        static::deleting(function ($model) {
            $model->subscribes->each->delete();
        });

        static::created(function ($model) {
            $model->subscribable->increment('members_count');
        });
    }

    public function subscribes()
    {
        return $this->morphMany('App\Models\Subscribe', 'subscribable');
    }

    public function isSubscribed()
    {
        return !!$this->subscribes->where('user_id', auth()->id())->count();
    }

    public function getIsSubscribedAttribute()
    {
        return $this->isSubscribed();
    }

    public function subscribe()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->subscribes()->where($attributes)->exists()) {
            return $this->subscribes()->create(['user_id' => auth()->id(), 'subscribable_id' => 1]);
        }
    }

    public function unSubscribe()
    {
        $attributes = ['user_id' => auth()->id()];

        if ($this->subscribes()->where($attributes)->exists()) {
            return $this->subscribes()->first()->delete();
        }
    }

    public function getSubscribesCountAttribute()
    {
        return $this->subscribes->count();
    }

}
