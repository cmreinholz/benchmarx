<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Response;
use Faker\Generator as Faker;

$factory->define(Response::class, function (Faker $faker) {
    return [
        
        'question_id'=>'11',
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = 50),
        'year' => now()->year,
        'response' => $faker->numberBetween($min = 20000, $max = 50000000),
        
    ]
    ;
    
});
