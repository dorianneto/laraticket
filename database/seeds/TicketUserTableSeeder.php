<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TicketUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tickets = App\Ticket::all();
        $ids = range(1, 3);

        foreach ($tickets as $ticket) {
            shuffle($ids);
            $ticket->users()->attach($ids[0], ['message' => $faker->paragraph]);
        }
    }
}
