<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Response;
use Illuminate\Support\Facades\DB;
use App\Category;


class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        $responses = Response::with('members')
            ->withCount(['likes as likes' => function($query){
                $query->where('like', '1');
            }, 'likes as dislikes' => function($query){
                $query->where('dislike', '1');
            }])
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'ASC')->get();


        $parentId = $responses->pluck('parent_id')->min();


        return view('custom.topic', compact('topic', 'responses', 'parentId'));
    }

    public function index()
    {
        $topics = Topic::paginate(10);
        $topicTableCounter =  (($_GET['page']?? 1)-1)*10+1;

        return view('admin.topics.index', compact('topics', 'topicTableCounter'));
    }


}
