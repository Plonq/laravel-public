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
                'title' => 'All Eyez on Me',
                'release_date' => '2017-06-15',
                'genre_id' => 12,
                'rating_id' => 5,
                'poster_path' => '/images/movies/1_poster.jpg',
                'cover_path' => '/images/movies/1_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'Channa Mereya',
                'release_date' => '2017-07-14',
                'genre_id' => 10,
                'rating_id' => 4,
                'poster_path' => '/images/movies/2_poster.jpg',
                'cover_path' => '/images/movies/2_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'A Monster Calls',
                'release_date' => '2017-07-27',
                'genre_id' => 2,
                'rating_id' => 3,
                'poster_path' => '/images/movies/3_poster.jpg',
                'cover_path' => '/images/movies/3_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'The Big Sick',
                'release_date' => '2017-08-03',
                'genre_id' => 1,
                'rating_id' => 4,
                'poster_path' => '/images/movies/4_poster.jpg',
                'cover_path' => '/images/movies/4_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'Laputa: Castle in the Sky',
                'release_date' => '2017-08-24',
                'genre_id' => 13,
                'rating_id' => 2,
                'poster_path' => '/images/movies/5_poster.jpg',
                'cover_path' => '/images/movies/5_cover.jpg',
                'featured' => true
            ]
        ]);
    }
}
