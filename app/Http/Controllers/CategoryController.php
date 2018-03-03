<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {


        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `responses2` SELECT `id`, `parent_id`, `topic_id`, `member_id`, `response`, `published`, 
                    `changed`, `created_at`, `updated_at`
                  FROM `responses`  ORDER BY `created_at` DESC ")
        );


        $raws = DB::table('categories')
            ->leftjoin('topics','categories.id', '=', 'topics.category_id')
            ->leftjoin('responses2','topics.id', '=',  'responses2.topic_id')
            ->leftjoin('members', 'responses2.member_id', '=', 'members.id')
            ->select('categories.id', 'categories.parent_id', 'categories.description', 'categories.title', 'categories.eng_title',
                  DB::raw(' responses2.response AS last_response,
                  COUNT(DISTINCT topics.id) AS topic_number, COUNT(DISTINCT responses2.id)  AS responses_number,
                   responses2.created_at AS response_added_at, members.name AS creator_name, responses2.id AS response_id, members.id AS creator_id'))
            ->groupBy('categories.id')
            ->get();


        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS responses2 ; ")
        );

        $counter = (($_GET['page']?? 1)-1)*10;

        return view('custom.index', compact ('raws', 'counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Category $category)
    {


        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `responses2` SELECT `id`, `parent_id`, `topic_id`, `member_id`, `response`, `published`, 
                    `changed`, `created_at`, `updated_at`
                  FROM `responses`  ORDER BY `created_at` DESC ")
        );


        $subCategories = DB::table('categories')
            ->leftjoin('topics','categories.id', '=', 'topics.category_id')
            ->leftjoin('responses2','topics.id', '=',  'responses2.topic_id')
            ->leftjoin('members', 'responses2.member_id', '=', 'members.id')
            ->select('categories.id', 'categories.parent_id', 'categories.description', 'categories.title', 'categories.eng_title',
                DB::raw(' responses2.response AS last_response,
                  COUNT(DISTINCT topics.id) AS topic_number, COUNT(DISTINCT responses2.id)  AS responses_number,
                   responses2.created_at AS response_added_at, members.name AS creator_name, responses2.id AS response_id, members.id AS creator_id'))
            ->where('categories.parent_id', $category->id)
            ->groupBy('categories.id')
            ->get();



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
            ->where('topics.category_id', $category->id)
            ->groupBy('topics.id')
            ->paginate(10);


        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS members2 ; ")
        );

        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS responses2 ; ")
        );

        $counter = (($_GET['page']?? 1)-1)*10;

        return view('custom.category', compact ('category', 'subCategories', 'topics', 'counter'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
