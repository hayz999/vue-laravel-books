<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title'         => $faker->text(50),
        'author'        => $faker->text(50),
        'publishedDate' => $faker->text(50),
        'genre'         => $faker->text(50)
    ];
});
