<?php

namespace App\Models;

use App\Events\ThreadHasNewReply;
use App\Events\ThreadReceivedNewReply;
use App\Notifications\ThreadWasUpdated;
use App\Spams\Spam;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Thread extends Model
{
    use Searchable;

    protected static function boot()
    {
        Parent::boot();

        static::deleting(function ($thread) {
            if ($thread->replies->count()) {
                $thread->reply->each->delete();
            }
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

    protected $casts = [
        'locked' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $appends = ['isSubscribeTo'];

    use RecordActivity;

    protected $with = ['user', 'channel'];

    protected $fillable = ['title', 'body', 'channel_id', 'slug'];

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //     Create Reply
    public function addReply($data)
    {
        if ($this->locked) {
            throw new \Exception('Thread is locked');
        }

        $reply =  $this->replies()->create($data);

        event(new ThreadReceivedNewReply($reply));

        $this->notifySubscribers($reply);

        return $reply;
    }

    public function notifySubscribers($reply)
    {
        $this->subscriptions
            ->where('user_id', '!=', $reply->user_id)
            ->each
            ->notify($reply);

    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->slug}";
    }

    public function path_channel()
    {
        return "/threads/{$this->channel->slug}";
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
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

    public function subscriptions()
    {
        return $this->hasMany('App\Models\ThreadSubscription');
    }

    public function getIsSubscribeToAttribute()
    {
        return !! $this->subscriptions()
                ->where('user_id', auth()->id())
                ->exists();
    }

    public function hasUpdatesFor($user = null)
    {
        $user = $user ?: auth()->user();

        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-". $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function markBestReply($reply)
    {
        $this->best_reply_id = $reply->id;

        $this->save();

        return response([], 200);
    }

    public function lock()
    {
        $this->locked = true;

        $this->save();
    }

    public function unLock()
    {
        $this->locked = false;

        $this->save();
    }

}
