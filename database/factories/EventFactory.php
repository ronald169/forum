<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph,
        'date' => now()->addMonth(rand(1, 7))
    ];
});
