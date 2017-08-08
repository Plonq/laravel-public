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
        'scheduled_at' => $faker->dateTimeBetween($startDate = $movie->release_date, $endDate = '+17 days', $timezone = date_default_timezone_get())->format('Y-m-d H:i:s'),
        'cinema_id' => App\Cinema::inRandomOrder()->first()->id,
        'movie_id' => $movie->id
    ];
});