<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            ['name' => 'Exempt', 'code' => 'E'],
            ['name' => 'General', 'code' => 'G'],
            ['name' => 'Parental Guidance', 'code' => 'PG'],
            ['name' => 'Mature', 'code' => 'M'],
            ['name' => 'Mature Accompanied', 'code' => 'MA15+'],
            ['name' => 'Restricted', 'code' => 'R18+'],
            ['name' => 'Restricted', 'code' => 'X18+'],
            ['name' => 'Refused Classification', 'code' => 'RC']
        ]);
    }
}
