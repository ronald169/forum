<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($model) {
            $model->favorite->increment('favorites_count');
        });

        static::deleted(function ($model) {
            $model->favorite->decrement('favorites_count');
        });
    }

    use RecordActivity;

    protected $fillable = ['user_id'];

    public function favorite()
    {
        return $this->morphTo();
    }

    public function path()
    {
        return $this->reply->path();
    }
}
