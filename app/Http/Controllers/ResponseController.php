<?php

namespace App\Http\Controllers;

use App\Events\ResponseWasAdded;
use App\Member;
use App\Topic;
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


        $template = (string)view('custom.partials.responseItem', compact('response'));

        broadcast( new ResponseWasAdded($response, $template ));

        return response()->json([
            'addResponseText' => $request->addResponseText,
            'responseId' => $response->id,
            '_token' => $request->_token,
            'status' => 'Ok',
            'message' => 'Response added successfully'
        ]);
    }



    public function showResponseToComment(Request $request)
    {
        $response = Response::find($request->id);
        return view('custom.partials.responseItemToComment', compact('response'));
    }



    //admin side
    public function index($parentId = 0)
    {
        $responses = Response::all();
        return view('admin.responses.index', compact('responses', 'parentId'));
    }

    public function create(Response $response)
    {
        $members = Member::all();
        $topics = Topic::all();
        $parentId = $response->id;
        $topicId = $response->topic_id;
        return view('admin.responses.create', compact('members', 'topics', 'parentId', 'topicId'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'addResponseText' => 'required',
            'published' =>'required'

        ]);

        $response = new Response;
        $response->parent_id = $request->parentId;
        $response->topic_id = $request->topicId;
        $response->member_id = $request->memberId;
        $response->response = $request->addResponseText;
        $response->published = $request->published;
        $response->save();

        return redirect('/admin/response')->with('status', 'Response added!');
    }


    public function edit(Response $response)
    {
        $members = Member::all();
        $topics = Topic::all();
        return view('admin.responses.edit', compact('response', 'members', 'topics'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'changeResponseText' => 'required',

        ]);

        $response =  Response::find($request->id);
        $response->parent_id = $request->parentId;
        $response->topic_id = $request->topicId;
        $response->member_id = $request->memberId;
        $response->response = $request->changeResponseText;
        $response->published = $request->published;
        $response->save();

        return redirect('/admin/response')->with('status', 'Response updated!');
    }


    public function destroy($id)
    {
        $response = Response::find($id);
        $response->delete();
        return redirect('/admin/response')->with('status', 'Response deleted!');
    }
}
