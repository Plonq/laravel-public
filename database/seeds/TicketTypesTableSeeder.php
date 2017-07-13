<?php

use Illuminate\Database\Seeder;

class TicketTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_types')->insert([
            ['name' => 'Adult', 'cost' => 19.00],
            ['name' => 'Child', 'cost' => 14.00],
            ['name' => 'Concession', 'cost' => 16.50],
            ['name' => 'Senior Citizen', 'cost' => 12.00],
            ['name' => 'Student', 'cost' => 16.50]
        ]);
    }
}
