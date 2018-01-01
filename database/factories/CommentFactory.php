<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'user_id' => function () {
        	$user = factory(App\User::class)->create();
        	$user->roles()
        		->save(
        			Role::where('name', 'member')->first()
        		);
        	return $user->id;
        }
    ];
});
