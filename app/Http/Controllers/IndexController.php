<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::unprepared(
            DB::raw("CREATE TEMPORARY TABLE `responses2` SELECT `id`, `parent_id`, `topic_id`, `response`, `published`, 
                    `changed`, `created_at`, `updated_at`
                  FROM `responses`  ORDER BY `created_at` DESC ")
        );


        $raws = DB::table('categories')
            ->leftjoin('topics','categories.id', '=', 'topics.category_id')
            ->leftjoin('responses2','topics.id', '=',  'responses2.topic_id')
            ->select('categories.id', 'categories.parent_id',  'categories.title', 'categories.eng_title',
                'responses2.response', 'responses2.created_at', DB::raw('COUNT(DISTINCT topics.id) AS topic_number, COUNT(DISTINCT responses2.id)
                 AS responses_number'))
            ->groupBy('categories.id')
            ->get();

        DB::unprepared(
            DB::raw(" DROP TABLE IF EXISTS responses2 ; ")
        );

        return view('custom.index', compact ('raws'));
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
    public function show($id)
    {
        //
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
