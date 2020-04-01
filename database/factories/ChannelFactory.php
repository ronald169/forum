<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {

    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => $name,
        'user_id' => function() {
            return User::latest()->first()->id;
        }
    ];
});
