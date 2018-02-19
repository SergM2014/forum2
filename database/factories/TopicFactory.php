<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(App\Topic::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    $categoryIds =Category::pluck('id')->toArray();
    return [
        'category_id' =>$faker->randomElement($categoryIds),
        'member_id' => $faker->numberBetween($min =1, $max =3),
        'title' => $title,
        'eng_title' => $title
    ];
});
