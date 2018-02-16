<?php

use Faker\Generator as Faker;
use App\Topic;

$factory->define(App\Response::class, function (Faker $faker) {

    $topicIds = Topic::all()->pluck('id')->toArray();

    return [
        'parent_id' =>$faker->numberBetween($min = 0, $max = 20),
        'topic_id' => $faker->randomElement($topicIds),
        'response' => $faker->paragraph,
        'published' => "1",
        'changed' =>"0",
    ];
});
