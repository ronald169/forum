<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {

    $title = $faker->sentence;

    $i = 1;

    $matiere = ['mathematique', 'physique', 'chimie',
        'histoire', 'geographie', 'ecm', 'anglais', 'francais', 'informatique',
        'phylosophie', 'svt', 'autre'];

    $class = ['6', '5', '4', '3', '2c', '2a', '2g', '1c', '1a', 'tc', 'ta', 'bacc+'];

    $level = ['a1', 'a2', 'b1', 'b2', 'c1'];

//    $betreuung = factory('App\Models\Betreuung')->create();

    return [
        'title' => $title,
        'level' => $level[rand(0, 4)],
        'lesson' => $i = ++$i,
        'slug' => \Illuminate\Support\Str::slug($title),
        'description' => $faker->paragraph,
        'matiere' => $matiere[rand(0, 11)],
        'class' => $class[rand(0, 11)],
        'body' => $faker->paragraphs(2, true),
        'user_id' => function() {
            return \App\User::get()->random()->id;
        },
        'betreuung' => function($betreuung) {
            return \App\Models\Betreuung::get()->random()->secret;
        },
        'betreuung_id' => function($betreuung) {
            return \App\Models\Betreuung::get()->random()->id;
        },
    ];
});
