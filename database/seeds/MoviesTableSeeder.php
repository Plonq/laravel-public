<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'name' => 'All Eyez on Me',
                'release_date' => '2017-06-15',
                'genre_id' => 12,
                'rating_id' => 5,
                'featured' => true
            ],
            [
                'name' => 'Channa Mereya',
                'release_date' => '2017-07-14',
                'genre_id' => 10,
                'rating_id' => 4,
                'featured' => false
            ],
            [
                'name' => 'A Monster Calls',
                'release_date' => '2017-07-27',
                'genre_id' => 2,
                'rating_id' => 3,
                'featured' => true
            ],
            [
                'name' => 'The Big Sick',
                'release_date' => '2017-08-03',
                'genre_id' => 1,
                'rating_id' => 4,
                'featured' => false
            ],
            [
                'name' => 'Laputa: Castle in the Sky',
                'release_date' => '2017-08-24',
                'genre_id' => 13,
                'rating_id' => 2,
                'featured' => false
            ]
        ]);
    }
}
