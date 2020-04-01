<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function threads()
    {
        return $this->hasMany('App\Models\Thread');
    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

    public function links()
    {
        return $this->hasMany('App\Models\CommunityLink');
    }

    public function path_link()
    {
        return '/communities/' . $this->id;
    }
}
