<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'parent_id'=> 0,
        'title'=> $title,
        'eng_title'=>$title,
        'description' => $faker->text($maxNbChars = 200)

    ];
});


$factory->state(App\Category::class, 'parentId', function ($faker) {
    return [
        'parent_id' => $faker->randomElement(App\Category::pluck('id')->toArray()),
    ];
});
