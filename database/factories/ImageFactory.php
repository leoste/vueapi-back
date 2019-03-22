<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'src' => 'https://picsum.photos/200/300/?blur&random&id=' . $faker->unique()->sha1,
        'type' => 'url'
    ];
});
