<?php

namespace App\Models;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{

    use Favoritable;

    protected $appends = ['favoritesCount', 'isFavorited'];

    protected $fillable = ['title', 'link', 'channel_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function scopeForChannel($builder, $channel)
    {
        if ($channel) {
            return $builder->where('channel_id', $channel->id);
        }

        return $builder;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
