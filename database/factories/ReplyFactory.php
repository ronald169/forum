<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function() {
            return \App\User::get()->random()->id;
        },
        'thread_id' => function() {
            return \App\Models\Thread::get()->random()->id;
        }
    ];
});
