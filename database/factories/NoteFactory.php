<?php

/** @var Factory $factory */

use App\Note;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'company'   => $faker->company,
        'contact'   => $faker->name,
        'issue'     => $faker->words(4, true),
        'details'   => $faker->paragraph,
        'time'      => $faker->numberBetween(1, 120),
        'status'    => 1,
    ];
});
