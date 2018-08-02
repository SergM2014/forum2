<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Response;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Member;


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

    public function create()
    {
        $members = Member::all();
        $categories = Category::all();
        return view('admin.topics.create', compact('members', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',

        ]);


        $engTitle = translite_in_Latin($request->title);

        $topic = new Topic;
        $topic->category_id = $request->categoryId;
        $topic->member_id = $request->memberId;
        $topic->title = $request->title;
        $topic->eng_title = $engTitle;
        $topic->save();


        return redirect('/admin/category')->with('status', 'Topic added!');

    }


}
