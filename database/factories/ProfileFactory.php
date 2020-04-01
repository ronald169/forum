<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {

    $class = ['6', '5', '4', '3', '2c', '2a', '2g', '1c', '1a', 'tc', 'ta', 'bacc+'];
    $fonction = ['student', 'professor', 'student', 'student'];

    return [
        'class' => $class[rand(0, 11)],
        'school' => $faker->words(3, true),
        'phone' => $faker->phoneNumber,
        'fonction' => $fonction[rand(0, 3)],
        'user_id' => function() {
            return factory('App\User')->create()->id;
        }
    ];
});
