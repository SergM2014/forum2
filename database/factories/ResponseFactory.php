<?php

use Faker\Generator as Faker;

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'parent_id' =>0,
        'topic_id '=> $faker->numberBetween($min = 1, $max = 10),
        'response' => $faker->paragraphs,
        'published' => '1',
        'changed' =>'0',
    ];
});
