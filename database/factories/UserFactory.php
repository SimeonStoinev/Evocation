<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $infoDownloaded = array_random([0, 1]);
    $verified = array_random([0, 1]);

    return [
        'card_id' => str_random(16),
        'name' => $faker->name,
        'family' => $faker->lastName,
        'email' => $faker->unique()->safeEmail . $faker->randomLetter . $faker->randomDigitNotNull,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'info_downloaded' => $infoDownloaded,
        'verified' => $verified,
        'remember_token' => str_random(10),
    ];
});