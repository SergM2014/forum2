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

    public function store(Request $request)
    {
        $request->validate([
            'addResponseText' => 'required',

        ]);

        $response = new Response;
        $response->parent_id = $request->parentId;
        $response->topic_id = $request->topicId;
        $response->member_id = session('memberId');
        $response->response = $request->addResponseText;
        $response->published = "1";
        $response->save();





        return response()->json([
            'addResponseText' => $request->addResponseText,
            'responseId' => $response->id,
            '_token' => $request->_token,
            'status' => 'Ok',
            'message' => 'Response added successfully'
        ]);
    }

    public function showAjaxAdded(Request $request)
    {
        $response = Response::find($request->id);
        return view('custom.partials.responseItem', compact('response'));

    }

    public function showResponseToComment(Request $request)
    {
        $response = Response::find($request->id);
        return view('custom.partials.responseItemToComment', compact('response'));
    }
}
