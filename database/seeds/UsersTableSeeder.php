<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

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
        ])->roles()->attach(Role::where('slug', 'manager')->first()->id);

        factory(App\User::class)->create([
            'email' => 'operator@operator.com',
            'password' => bcrypt('operator')
        ])->roles()->attach(Role::where('slug', 'operator')->first()->id);

        factory(App\User::class, 3)->create([
            'password' => bcrypt('123123')
        ])->each(function($item) {
            return $item->roles()->attach(Role::where('slug', 'customer')->first()->id);
        });
    }
}
