<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'code' => $faker->name,
        'title' => $faker->sentence,
        'description' => $faker->text,
        'university_id' => 1,
        'user_id' => 1
    ];
});
