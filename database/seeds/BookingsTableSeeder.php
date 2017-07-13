<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 1,
                'payment_detail_id' => 1,
                'created_at' => '2017-06-11 12:35:12'
            ],
            [
                'user_id' => 1,
                'payment_detail_id' => 1,
                'created_at' => '2017-05-16 14:42:37'
            ]
        ]);
    }
}
