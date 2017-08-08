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
                'poster_image_url' => 'https://image.tmdb.org/t/p/original/zmgsaKFWbmZ1Grz4SO0PLNxilv3.jpg',
                'cover_image_url' => 'https://image.tmdb.org/t/p/original/1642Z6Jz4YtrFa5YJyN6N6FrD8M.jpg',
                'featured' => true
            ],
            [
                'title' => 'Channa Mereya',
                'release_date' => date('Y-m-d', strtotime('-1 day')),
                'genre_id' => 10,
                'rating_id' => 4,
                'poster_image_url' => 'https://www.newsfolo.com/wp-content/uploads/2017/06/cm-1.png',
                'cover_image_url' => 'https://2.bp.blogspot.com/-st-I20fh6ZI/WFKnQACXTlI/AAAAAAAAP1k/Obw6iXSPSUElpMPmgclKPPIQ63ExN4cGQCLcB/w1200-h630-p-k-no-nu/Download-Channa-Mereya-%2528ADHM%2529-DJ-NYK-Future-Bass-Remix.jpg',
                'featured' => true
            ],
            [
                'title' => 'A Monster Calls',
                'release_date' => date('Y-m-d', strtotime('-2 days')),
                'genre_id' => 2,
                'rating_id' => 3,
                'poster_image_url' => 'https://image.tmdb.org/t/p/original/oqZ0MBWxNrArZpyVqk3QGAA37QL.jpg',
                'cover_image_url' => 'https://image.tmdb.org/t/p/original/69hvi7xf6VIRRJduSYl1yZIzJn8.jpg',
                'featured' => true
            ],
            [
                'title' => 'The Big Sick',
                'release_date' => date('Y-m-d', strtotime('+1 days')),
                'genre_id' => 1,
                'rating_id' => 4,
                'poster_image_url' => 'https://image.tmdb.org/t/p/w220_and_h330_bestv2/qquEFkFbQX1i8Bal260EgGCnZ0f.jpg',
                'cover_image_url' => 'https://image.tmdb.org/t/p/original/fYI8WX2DquAHMqwh5mOMxc6RU5j.jpg',
                'featured' => true
            ],
            [
                'title' => 'Laputa: Castle in the Sky',
                'release_date' => date('Y-m-d'),
                'genre_id' => 13,
                'rating_id' => 2,
                'poster_image_url' => 'https://image.tmdb.org/t/p/w220_and_h330_bestv2/4RTG2AaqZ9eleL51ryWwv78WwDu.jpg',
                'cover_image_url' => 'https://image.tmdb.org/t/p/w350_and_h196_bestv2/baXCl6ayI2FGtwtXdPduvYJU1ET.jpg',
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
