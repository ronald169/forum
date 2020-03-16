<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function threads()
    {
        return $this->hasMany('App\Models\Thread');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
