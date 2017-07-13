<?php

use Illuminate\Database\Seeder;

class WishlistItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlist_items')->insert([
            [
                'movie_id' => 5,
                'comment' => 'Friend asked me to watch this',
                'user_id' => 2
            ],
            [
                'movie_id' => 4,
                'comment' => 'Always wanted to see this',
                'user_id' => 2
            ]
        ]);
    }
}
