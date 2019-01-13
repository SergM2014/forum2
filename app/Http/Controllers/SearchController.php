<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Topic;

class SearchController extends Controller
{
    public function showPreview(Request $request)
    {
        $topics = Topic::search($request->searched)->get()->take(5);

       // $topics = array_slice($result, 0, 5);

        $categories = Category::search($request->searched)->get()->take(5);
       // $categories = array_slice($result, 0, 5);


        return view('custom.search.preview', compact('topics', 'categories'));
    }
}
