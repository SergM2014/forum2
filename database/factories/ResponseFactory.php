<?php

use Faker\Generator as Faker;
use App\Topic;
use App\Member;

$factory->define(App\Response::class, function (Faker $faker) {

    $topicIds = Topic::all()->pluck('id')->toArray();
    $membersIds = Member::all()->pluck('id')->toArray();

    return [
        'parent_id' =>$faker->numberBetween($min = 0, $max = 20),
        'topic_id' => $faker->randomElement($topicIds),
        'member_id' => $faker->randomElement($membersIds),
        'response' => $faker->paragraph,
        'published' => "1",
        'changed' =>"0",
    ];
});
