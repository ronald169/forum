<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

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
