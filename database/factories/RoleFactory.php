<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => 'member',
        'permissions' => [
            'create-own-post' => true,
            'update-own-post' => true,
            'delete-own-post' => true,
            'access-member-area' => true
	    ]
	];
});

$factory->state(App\Role::class, 'admin', [
        'name' => 'admin',
        'permissions' => [
        	'access-admin-panel' => true,
	        'create-own-post' => true,
	        'update-any-post' => true,
	        'delete-any-post' => true,
	        'view-any-post' => true,
	        'publish-any-post' => true,
	        'unpublish-any-post' => true
	    ]
]);
