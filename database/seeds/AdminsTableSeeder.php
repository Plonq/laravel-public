<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'admin@mavericks.com',
                'password' => password_hash('adminadmin', PASSWORD_DEFAULT)
            ],
        ]);
    }
}
