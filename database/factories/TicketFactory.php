<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    $entity = function($class) {
        return !$class::all()->isEmpty() ?
            $class::all()->random()->id : factory($class)->create()->id;
    };

    return [
        'title'         => $faker->sentence(4),
        'situation'     => 'open',
        'notification'  => 0,
        'user_id'       => $entity(App\User::class),
        'department_id' => $entity(App\Department::class),
        'priority_id'   => $entity(App\Priority::class),
        'category_id'   => $entity(App\Category::class)
    ];
});
