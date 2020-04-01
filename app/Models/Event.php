<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $dates = ['date'];

    protected $fillable = ['description', 'date', 'betreuung_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
