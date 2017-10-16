<?php

use Faker\Generator as Faker;

$uniqueName = [];

$factory->define(App\Role::class, function (Faker $faker) use (&$uniqueName) {
    do {
        $name = $faker->randomElement(['Manager', 'Operator', 'Customer']);
    } while (in_array($name, $uniqueName));

    $uniqueName[] = $name;
    $slug         = str_slug($name, '-');
    $permissions  = [
        'show-ticket'   => null,
        'create-ticket' => null,
        'close-ticket'  => null,
        'update-ticket' => null,
        'delete-ticket' => null
    ];

    switch($name) {
        case 'Manager':
            $permissions['show-ticket']   = true;
            $permissions['create-ticket'] = true;
            $permissions['close-ticket']  = true;
            $permissions['update-ticket'] = true;
            $permissions['delete-ticket'] = true;
            break;
        case 'Operator':
            $permissions['show-ticket']   = true;
            $permissions['create-ticket'] = true;
            $permissions['close-ticket']  = true;
            $permissions['update-ticket'] = false;
            $permissions['delete-ticket'] = false;
            break;
        case 'Customer':
            $permissions['show-ticket']   = true;
            $permissions['create-ticket'] = true;
            $permissions['close-ticket']  = false;
            $permissions['update-ticket'] = false;
            $permissions['delete-ticket'] = false;
            break;
    }

    return [
        'name'        => $name,
        'slug'        => $slug,
        'permissions' => json_encode($permissions)
    ];
});
