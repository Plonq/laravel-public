<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            [
                'quantity' => 2,
                'ticket_type_id' => 1,
                'session_id' => 2,
                'booking_id' => 1,
            ],
            [
                'quantity' => 2,
                'ticket_type_id' => 2,
                'session_id' => 2,
                'booking_id' => 1,
            ],
            [
                'quantity' => 1,
                'ticket_type_id' => 4,
                'session_id' => 5,
                'booking_id' => 2,
            ]
        ]);
    }
}
