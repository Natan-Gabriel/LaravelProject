<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aircraft;
use Faker\Generator as Faker;

$factory->define(Aircraft::class, function (Faker $faker) {
   $aircrafts = App\Aircraft::pluck('id')->toArray();
    return [
      'name'=> substr($faker->sentence(2), 0, -1), 
      'hub_id'=> function () {
            return factory(App\Hub::class)->create()->id;
        },// =>$faker->randomElement($aircrafts),
           
      //'hub_id'
    ];
});
