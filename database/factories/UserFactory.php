<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'genre'          => $faker->randomElement(['M', 'F']),
        'remember_token' => str_random(10),
        'department_id'  => function() {
            return !App\Department::all()->isEmpty() ?
                App\Department::all()->random()->id : factory(App\Department::class)->create()->id;
        }
    ];
});
