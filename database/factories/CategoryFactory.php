<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    $date = $faker->dateTimeBetween('-1 years', 'now');
    return [
        'name' => $faker->department,
        'created_at' => $date,
        'updated_at' => $date
    ];
});
