<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PrioritiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(TicketUserTableSeeder::class);
    }
}
