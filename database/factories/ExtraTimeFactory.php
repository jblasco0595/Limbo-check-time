<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExtraTime;
use Faker\Generator as Faker;

$factory->define(ExtraTime::class, function (Faker $faker) {
    return [
        'user_id' => 3,
        'hours' => $faker->numberBetween($min = 5, $max = 25),
        'description' => $faker->text
    ];
});
