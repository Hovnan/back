<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->paragraph(random_int(1, 10)),
        'price' => $faker->randomFloat(2, 1, 100),
        'user_id' => App\User::all()->random()->id
    ];
});
