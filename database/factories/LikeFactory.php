<?php

use Faker\Generator as Faker;
use App\Response;
use App\Member;

$factory->define(App\Like::class, function (Faker $faker) {

    $responseIdArray = Response::pluck('id')->toArray();
    $memberIdArray = Member::pluck('id')->toArray();
    $like = $faker->randomElement($array = array ('0','1'));
    $dislike =  $like == '0'? '1': '0';
    $responseId = $faker->randomElement($responseIdArray);
    $memberId = $faker->randomElement($memberIdArray);

    $founded = App\Like::where('response_id', $responseId)->where('member_id', $memberId)->first();
    if($founded) return [];

    return [
        'response_id' => $responseId,
        'member_id' => $memberId,
        'like' => $like,
        'dislike' => $dislike
    ];
});
