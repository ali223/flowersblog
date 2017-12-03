<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'user_id' => function () {
        	return factory(App\User::class)->create()->id;
        }
    ];
});
