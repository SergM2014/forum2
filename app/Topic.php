<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Topic extends Model
{

    protected $fillable = [
      'category_id', 'member_id', 'title', 'eng_title'
    ];



    public function comments()
    {
        return $this->hasMany('App\Response');
    }

    public function members()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }


    public static function getTopics($categoryId)
    {
        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `responses2` SELECT `id`, `parent_id`, `topic_id`, `member_id`, `response`, `published`, 
                    `changed`, `created_at`, `updated_at`
                  FROM `responses`  ORDER BY `created_at` DESC ")
        );

        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `members2` SELECT `id`, `avatar`, `name`  FROM `members`  ")
        );


        $topics = DB::table('topics')
            ->leftjoin('responses2','topics.id', '=',  'responses2.topic_id')
            ->leftjoin('members', 'responses2.member_id', '=', 'members.id')
            ->leftjoin('members2', 'topics.member_id', '=', 'members2.id')
            ->select('topics.id', 'topics.title', DB::raw(' responses2.response AS last_response, COUNT(DISTINCT responses2.id)  AS responses_number,
                   responses2.created_at AS response_added_at, members.name AS creator_name, responses2.id AS response_id, members.id AS creator_id,
                   members2.name AS starter_name, topics.member_id AS starter_id'))
            ->where('topics.category_id', $categoryId)
            ->groupBy('topics.id')
            ->paginate(10);


        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS members2 ; ")
        );

        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS responses2 ; ")
        );

        return $topics;
    }
}
