<?php

use Faker\Generator as Faker;

$factory->define(App\Priority::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->randomElement([
            'Urgente',
            'Importante',
            'Moderado',
            'Baixa'
        ]),
        'description' => $faker->sentence
    ];
});
