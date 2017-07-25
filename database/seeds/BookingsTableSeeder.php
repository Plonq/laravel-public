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
                'created_at' => '2017-06-11 12:35:12',
                'name' => 'Fred Johnson',
                'address' => '123 Fake St',
                'city' => 'Fakeville',
                'postcode' => '3351',
                'cc_number' => '3333444455552222',
                'cc_expiry_month' => 12,
                'cc_expiry_year' => 2020,
                'cc_cvc' => '133'
            ],
            [
                'user_id' => 2,
                'created_at' => '2017-05-16 14:42:37',
                'name' => 'John Johnson',
                'address' => '890 Billing Rd',
                'city' => 'Creditville',
                'postcode' => '2250',
                'cc_number' => '1111222233334444',
                'cc_expiry_month' => 11,
                'cc_expiry_year' => 2024,
                'cc_cvc' => '111'
            ]
        ]);
    }
}
