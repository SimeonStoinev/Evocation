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
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'info_downloaded' => $infoDownloaded,
        'verified' => $verified,
        'remember_token' => str_random(10),
    ];

    /*
        $table->increments('id');
        $table->char('card_id', 16)->default(0);
        $table->string('name');
        $table->string('family');
        $table->string('email')->unique();
        $table->string('password');
        $table->char('rank', 15)->comment('admin, headmaster, subheadmaster, teacher, student, parent');
        $table->index('rank');
        $table->boolean('is_classteacher')->default(0)->comment('Applies only to teachers which are leading a class.');
        $table->integer('grade_id')->default(0);
        $table->index('grade_id');
        $table->integer('school_id')->default(0);
        $table->index('school_id');
        $table->integer('family_link_id')->default(0)->comment('Applies only to parents and students.');
        $table->index('family_link_id');
        $table->boolean('info_downloaded')->default(0)->comment('GDPR');
        $table->boolean('verified')->default(0);
        $table->timestamp('email_verified_at')->nullable();
        $table->rememberToken();
        $table->timestamps();
    */
});