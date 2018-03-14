<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Category extends Model
{


    protected $fillable = [
      'parent_id', 'title', 'description', 'eng_title'
    ];



    public static function getCategories($parentId = 0)
    {
        $perPage = config('app.perPageCategories');
        $total = DB::table('categories')
            ->where('parent_id', $parentId)
            ->count();


        $page = LengthAwarePaginator::resolveCurrentPage(config('app.categoriesPageString'));
        $offSet = ($page * config('app.perPageCategories'))-config('app.perPageCategories');


        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `responses2` SELECT `id`, `parent_id`, `topic_id`, `member_id`, `response`, `published`, 
                    `changed`, `created_at`, `updated_at`
                  FROM `responses`  ORDER BY `created_at` DESC ")
        );


        $results = DB::table('categories')
            ->leftjoin('topics','categories.id', '=', 'topics.category_id')
            ->leftjoin('responses2','topics.id', '=',  'responses2.topic_id')
            ->join('members', 'responses2.member_id', '=', 'members.id')
            ->join('topics AS topics2', 'responses2.topic_id', '=', 'topics2.id')
            ->select('categories.id', 'categories.parent_id', 'categories.description', 'categories.title',
                'categories.eng_title',
                DB::raw(' topics2.title AS response_topic, topics2.id AS response_topic_id,
                  COUNT(DISTINCT topics.id) AS topic_number, COUNT(DISTINCT responses2.id)  AS responses_number,
                   responses2.created_at AS response_added_at, members.name AS creator_name,
                    responses2.id AS response_id, members.id AS creator_id'))
            ->groupBy('categories.id')
            ->having('categories.parent_id', $parentId)
            ->get();



        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS responses2 ; ")
        );

        $itemsForCurrentPage = array_slice($results->toArray(), $offSet, config('app.perPageCategories'), true);

        $raws = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(config('app.categoriesPageString')),
        ]);
        $raws ->setPageName(config('app.categoriesPageString'));


        return $raws;

    }




}
