<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    $date = $faker->dateTimeBetween('-1 years', 'now');
    return [
        'name' => $faker->productName,
        'category_id' => $faker->numberBetween(1, 3),
        'price' => $faker->numberBetween(5.00, 100.00),
        'rating' => $faker->numberBetween(1, 5),
        'description' => $faker->text(200),
        'image' => 'images/default150x150.png',
        'created_at' => $date,
        'updated_at' => $date
    ];
});
