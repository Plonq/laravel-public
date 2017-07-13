<?php

use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->insert([
            [
                'scheduled_at' => '2017-06-15 16:30:00',
                'movie_id' => 1,
                'cinema_id' => 6,
            ],
            [
                'scheduled_at' => '2017-06-15 19:00:00',
                'movie_id' => 1,
                'cinema_id' => 6,
            ],
            [
                'scheduled_at' => '2017-06-15 16:30:00',
                'movie_id' => 1,
                'cinema_id' => 4,
            ],
            [
                'scheduled_at' => '2017-06-15 19:00:00',
                'movie_id' => 1,
                'cinema_id' => 4,
            ],
            [
                'scheduled_at' => '2017-06-15 16:30:00',
                'movie_id' => 1,
                'cinema_id' => 2,
            ],
            [
                'scheduled_at' => '2017-06-15 19:00:00',
                'movie_id' => 1,
                'cinema_id' => 2,
            ],
            [
                'scheduled_at' => '2017-07-14 15:30:00',
                'movie_id' => 2,
                'cinema_id' => 1,
            ],
            [
                'scheduled_at' => '2017-07-14 18:00:00',
                'movie_id' => 2,
                'cinema_id' => 1,
            ],
            [
                'scheduled_at' => '2017-07-14 15:30:00',
                'movie_id' => 2,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-07-14 18:00:00',
                'movie_id' => 2,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-07-14 12:30:00',
                'movie_id' => 2,
                'cinema_id' => 5,
            ],
            [
                'scheduled_at' => '2017-07-14 17:00:00',
                'movie_id' => 2,
                'cinema_id' => 5,
            ],
            [
                'scheduled_at' => '2017-07-27 17:00:00',
                'movie_id' => 3,
                'cinema_id' => 4,
            ],
            [
                'scheduled_at' => '2017-07-27 11:00:00',
                'movie_id' => 3,
                'cinema_id' => 4,
            ],
            [
                'scheduled_at' => '2017-07-27 07:00:00',
                'movie_id' => 3,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-07-27 10:30:00',
                'movie_id' => 3,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-08-03 17:00:00',
                'movie_id' => 4,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-08-03 23:00:00',
                'movie_id' => 4,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-08-24 17:00:00',
                'movie_id' => 5,
                'cinema_id' => 3,
            ],
            [
                'scheduled_at' => '2017-08-24 11:00:00',
                'movie_id' => 5,
                'cinema_id' => 1,
            ],
            [
                'scheduled_at' => '2017-08-24 17:00:00',
                'movie_id' => 5,
                'cinema_id' => 6,
            ],
            [
                'scheduled_at' => '2017-08-25 11:00:00',
                'movie_id' => 5,
                'cinema_id' => 6,
            ]
        ]);
    }
}
