<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = App\Role::all();
        $ids = range(1, 3);

        foreach ($roles as $role) {
            shuffle($ids);
            $role->users()->attach($ids[0]);
            unset($ids[0]);
        }
    }
}
