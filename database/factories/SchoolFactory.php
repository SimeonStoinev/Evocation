<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        'title' => 'II СУ "Проф. Никола Маринов"'
    ];
});
