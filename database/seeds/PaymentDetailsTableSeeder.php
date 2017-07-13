<?php

use Illuminate\Database\Seeder;

class PaymentDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_details')->insert(
            [
                'cc_name' => 'John Johnson',
                'cc_number' => '1111222233334444',
                'cc_expiry_month' => 11,
                'cc_expiry_year' => 2024,
                'cc_cvc' => 111,
                'address' => '890 Billing Rd',
                'city' => 'Creditville',
                'postcode' => 2250,
                'user_id' => 1
            ]
        );
    }
}
