<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Betreuung;
use Faker\Generator as Faker;

$factory->define(Betreuung::class, function (Faker $faker) {

    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => \Illuminate\Support\Str::slug($title),
        'avatar' => '/zondicons/undraw_Graduation_ktn0.svg',
        'secret' => uniqid('secret_', true),
        'description' => $faker->paragraph,
        'user_id' => function() {
            return \App\User::get()->random()->id;
        },
    ];
});
