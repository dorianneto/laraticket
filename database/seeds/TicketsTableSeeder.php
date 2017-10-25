<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = \App\User::whereHas('roles', function($query) { return $query->where('role_id', 3);})->first();

        factory(App\Ticket::class, 1)->create([
            'situation' => 'in progress',
            'user_id'   => $user
        ])->each(function($item) use ($faker, $user) {
            return $item->users()->attach($user, [
                'message' => $faker->paragraph,
                'created_at' => \Carbon\Carbon::now()
            ]);
        });
    }
}
