<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {

    $title = $faker->sentence;

    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function() {
            return factory('App\Models\Channel')->create()->id;
        },
        'title' => $title,
        'slug' => \Illuminate\Support\Str::slug($title),
        'body' => $faker->paragraph,
        'locked' => false
    ];
});
