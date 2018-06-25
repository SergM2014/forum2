<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Topic;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {

        $categories = Category::getCategories();


        $categoriesCounter = (($_GET[config('app.categoriesPageString')]?? 1)-1)*config('app.perPageCategories');

        $parentId = 0;

        return view('custom.index', compact ('parentId', 'categories',  'categoriesCounter'));
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
        $categories = Category::getCategories($category->id);


        $categoriesCounter = (($_GET[config('app.categoriesPageString')]?? 1)-1)*config('app.perPageCategories');

        $topics = Topic::getTopics($category->id);

        $topicCounter = (($_GET['page']?? 1)-1)*10;

        $parentId = $category->id;

        return view('custom.category', compact ('category', 'parentId', 'categories',  'categoriesCounter', 'topics', 'topicCounter' ));

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


    public function adminAll()
    {
        $categories = Category::getAdminCategories();


        $categoriesCounter = (($_GET[config('app.categoriesPageString')]?? 1)-1)*config('app.perPageCategories');

        $parentId = 0;


        return view('admin.categories', compact ('parentId', 'categories',  'categoriesCounter'));

    }

}
