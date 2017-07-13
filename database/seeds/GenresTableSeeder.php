<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Action'],
            ['name' => 'Horror'],
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Crime'],
            ['name' => 'History'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Thriller']
        ]);
    }
}
