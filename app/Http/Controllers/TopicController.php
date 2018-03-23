<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Response;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        /*$responses = Response::with('members')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'ASC')->get();*/

        $responses = DB::table('responses')
            ->select('responses.id as id','parent_id', 'response', 'responses.created_at as created_at',
                'name', 'members.id as member_id', 'avatar' )
            ->leftJoin('members', 'member_id', '=', 'members.id')
            ->where('topic_id', $topic->id )->get();


        $parentId = $responses->pluck('parent_id')->min();





        return view('custom.topic', compact('topic', 'responses', 'parentId'));
    }
}
