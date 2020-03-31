<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Fee::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween($min = 500, $max = 100000),
    ];
});
