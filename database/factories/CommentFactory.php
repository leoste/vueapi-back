<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $user = \App\User::inRandomOrder()->first();
    return [
        'content' => $faker->text(),
        'user_id' => $user->id
    ];
});
