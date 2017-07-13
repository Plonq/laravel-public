<?php

use Illuminate\Database\Seeder;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cinemas')->insert([
            [
                'address' => '8 Louis Street',
                'city' => 'Airport West',
                'postcode' => 3042
            ],
            [
                'address' => '619 Doncaster Road',
                'city' => 'Doncaster',
                'postcode' => 3108
            ],
            [
                'address' => 'Cnr Heaths & Derrimut Rds',
                'city' => 'Werribee',
                'postcode' => 3030
            ],
            [
                'address' => '163 Brisbane St',
                'city' => 'Launceston',
                'postcode' => 7250
            ],
            [
                'address' => '181 Collins St',
                'city' => 'Hobart',
                'postcode' => 7000
            ],
            [
                'address' => '456 Dean St',
                'city' => 'Albury',
                'postcode' => 2640
            ]
        ]);
    }
}
