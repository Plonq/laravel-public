<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Movie::class, function (Faker\Generator $faker) {

    $title = str_replace('.', '', $faker->sentence($nbWords = 3, $variableNbWords = true));

    return [
        'title' => $title,
        'release_date' => $faker->dateTimeBetween($startDate = '-2 days', $endDate = '+15 days', $timezone = date_default_timezone_get())->format('Y-m-d'),
        'poster_image_url' => $faker->imageUrl(500, 750, 'abstract', true),
        'cover_image_url' => $faker->imageUrl(1280, 720, 'abstract', true),
        'featured' => 0,
        'genre_id' => App\Genre::inRandomOrder()->first()->id,
        'rating_id' => App\Rating::inRandomOrder()->first()->id
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\MovieSession::class, function (Faker\Generator $faker) {

    $movie = App\Movie::inRandomOrder()->first();

    return [
        'scheduled_at' => $faker->dateTimeBetween($startDate = $movie->release_date, $endDate = '+17 days', $timezone = date_default_timezone_get())->format('Y-m-d H:i'),
        'cinema_id' => App\Cinema::inRandomOrder()->first()->id,
        'movie_id' => $movie->id
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Booking::class, function (Faker\Generator $faker) {

    $user = App\User::inRandomOrder()->first();

    return [
        'name' => $user->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'cc_number' => $faker->creditCardNumber,
        'cc_expiry_month' => explode('/', $faker->creditCardExpirationDateString)[0],
        'cc_expiry_year' => explode('/', $faker->creditCardExpirationDateString)[1],
        'cc_cvc' => $faker->numberBetween(100,9999),
        'user_id' => $user->id,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Ticket::class, function (Faker\Generator $faker) {

    // Note booking and session should be overwritten when using this factory to generate realistic data
    $booking = App\Booking::inRandomOrder()->first();
    $movie_session = App\MovieSession::inRandomOrder()->first();
    $ticket_type = App\TicketType::inRandomOrder()->first();

    return [
        'quantity' => $faker->numberBetween(1, 10),
        'booking_id' => $booking->id,
        'movie_session_id' => $movie_session->id,
        'ticket_type_id' => $ticket_type->id,
    ];
});