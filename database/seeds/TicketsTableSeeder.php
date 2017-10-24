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
        factory(App\Ticket::class, 3)->create();

        factory(App\Ticket::class, 2)->create()->each(function($item) use ($faker) {
            return $item->users()->attach(2, [
                'message' => $faker->paragraph,
                'created_at' => \Carbon\Carbon::now()
            ]);
        });
    }
}
