<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Meta-data
        $this->call(GenresTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(TicketTypesTableSeeder::class);

        // Actual data
        $this->call(UsersTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(CinemasTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(PaymentDetailsTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(WishlistItemsTableSeeder::class);
    }
}
