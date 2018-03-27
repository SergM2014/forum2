<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Response;

class ResponseController extends Controller
{
    public function show(Response $response)
    {

        $responses = Response::with('members')
            ->where('topic_id', $response->topic_id)
            ->orderBy('created_at', 'ASC')->get();

        $parentId = $responses->pluck('parent_id')->min();
        $topicId = $response->topic_id;
        $responseId = $response->id;


        return view('custom.response', compact( 'responses', 'responseId', 'topicId', 'parentId'));
    }
}
