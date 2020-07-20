<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hub;
use Faker\Generator as Faker;

$factory->define(Hub::class, function (Faker $faker) {
    return [
      'name'=> $faker->city,
      'code'=> strtoupper($faker->lexify('???')),
      'price'=> $faker->numberBetween($min =0 , $max = 100000),
      'reputation'=> $faker->numberBetween($min = 0, $max = 100),
    ];
});
