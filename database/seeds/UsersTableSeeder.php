<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'email' => 'manager@manager.com',
            'password' => bcrypt('manager')
        ])->roles()->attach(3);

        factory(App\User::class)->create([
            'email' => 'operator@operator.com',
            'password' => bcrypt('operator')
        ])->roles()->attach(1);

        factory(App\User::class, 3)->create([
            'password' => bcrypt('123123')
        ])->each(function($item) {
            return $item->roles()->attach(2);
        });
    }
}
