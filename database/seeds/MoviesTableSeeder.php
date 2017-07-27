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
        // Custom entries
        DB::table('movies')->insert([
            [
                'title' => 'All Eyez on Me',
                'release_date' => date('Y-m-d'),
                'genre_id' => 12,
                'rating_id' => 5,
                'poster_path' => '/images/movies/1_poster.jpg',
                'cover_path' => '/images/movies/1_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'Channa Mereya',
                'release_date' => date('Y-m-d', strtotime('-1 day')),
                'genre_id' => 10,
                'rating_id' => 4,
                'poster_path' => '/images/movies/2_poster.jpg',
                'cover_path' => '/images/movies/2_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'A Monster Calls',
                'release_date' => date('Y-m-d', strtotime('-2 days')),
                'genre_id' => 2,
                'rating_id' => 3,
                'poster_path' => '/images/movies/3_poster.jpg',
                'cover_path' => '/images/movies/3_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'The Big Sick',
                'release_date' => date('Y-m-d', strtotime('+1 days')),
                'genre_id' => 1,
                'rating_id' => 4,
                'poster_path' => '/images/movies/4_poster.jpg',
                'cover_path' => '/images/movies/4_cover.jpg',
                'featured' => true
            ],
            [
                'title' => 'Laputa: Castle in the Sky',
                'release_date' => date('Y-m-d'),
                'genre_id' => 13,
                'rating_id' => 2,
                'poster_path' => '/images/movies/5_poster.jpg',
                'cover_path' => '/images/movies/5_cover.jpg',
                'featured' => false
            ]
        ]);

        // Delete generated images
        $files = glob('public/images/movies/generated/*.jpg');
        foreach($files as $file) {
            if(is_file($file))
            unlink($file);
        }

        // Generate random movies (with images)
        factory(App\Movie::class, 15)->create();
    }
}
