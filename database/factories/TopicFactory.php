<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'category_id' =>1,
        'member_id' => $faker->numberBetween($min =1, $max =3),
        'title' => $title,
        'eng_title' => $title
    ];
});
