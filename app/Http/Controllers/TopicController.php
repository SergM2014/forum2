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
        $responses = Response::with('members')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'ASC')->get();


        $parentId = $responses->pluck('parent_id')->min();





        return view('custom.topic', compact('topic', 'responses', 'parentId'));
    }
}
