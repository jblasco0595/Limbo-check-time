<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\TimeRange;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(TimeRange::class, function (Faker $faker) {

    $min = 0;
    $max = 18000;

    $rightInitTime = Carbon::today()->addHours( $faker->numberBetween( 0, 23 ) )->addMinutes( $faker->numberBetween( 0, 60 ) )->addSeconds( $faker->numberBetween( 0, 60 ) );
    $rightEndTime= Carbon::createFromFormat('Y-m-d H:i:s', $rightInitTime)->addHours( $faker->numberBetween( 0, 2 ) )->addMinutes( $faker->numberBetween( 0, 60 ) )->addSeconds( $faker->numberBetween( 0, 60 ) );
    
    return [
        'user_id' => User::all()->random()->id,
        'init_time' => $rightInitTime,
        'end_time' => $rightEndTime,
    ];

});
