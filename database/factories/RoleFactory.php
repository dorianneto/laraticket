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
        'metric-ticket'  => null,
        'list-ticket'    => null,
        'show-ticket'    => null,
        'delete-ticket'  => null,
        'create-ticket'  => null,
        'edit-profile'   => null,
        'see-auxiliares' => null
    ];

    switch($name) {
        case 'Manager':
            $permissions['metric-ticket']  = true;
            $permissions['list-ticket']    = true;
            $permissions['show-ticket']    = true;
            $permissions['delete-ticket']  = true;
            $permissions['create-ticket']  = true;
            $permissions['edit-profile']   = true;
            $permissions['see-auxiliares'] = true;
            break;
        case 'Operator':
            $permissions['metric-ticket']  = false;
            $permissions['list-ticket']    = true;
            $permissions['show-ticket']    = true;
            $permissions['delete-ticket']  = true;
            $permissions['create-ticket']  = false;
            $permissions['edit-profile']   = true;
            $permissions['see-auxiliares'] = false;
            break;
        case 'Customer':
            $permissions['metric-ticket']  = false;
            $permissions['list-ticket']    = true;
            $permissions['show-ticket']    = true;
            $permissions['delete-ticket']  = false;
            $permissions['create-ticket']  = true;
            $permissions['edit-profile']   = true;
            $permissions['see-auxiliares'] = false;
            break;
    }

    return [
        'name'        => $name,
        'slug'        => $slug,
        'permissions' => $permissions
    ];
});
