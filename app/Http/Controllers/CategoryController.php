<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Topic;
use App\Member;

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
        $members = Member::all();
        $categories = Category::all();
        return view('admin.categories.create', compact('members', 'categories'));
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
            'description' => 'required',
        ]);


        $engTitle = translite_in_Latin($request->title);

         $category = new Category;
         $category->parent_id = $request->parentId;
         $category->member_id = $request->memberId;
         $category->title = $request->title;
         $category->eng_title = $engTitle;
         $category->description = $request->description;
         $category->save();


        return redirect('/admin/category')->with('status', 'Category added!');

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
    public function edit(Category $category)
    {


        $members = Member::all();
        $categories = Category::all();
        $categoryParentId = old('parentId')?? $category->parent_id;
        $categoryMemberId = old('memberId')?? $category->member_id;

        return view('admin.categories.edit',
            compact('members', 'categories', 'category', 'categoryMemberId', 'categoryParentId'));

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);



       $engTitle = translite_in_Latin($request->title);

       $category = Category::find($id);
        $category->parent_id = $request->parentId;
        $category->member_id = $request->memberId;
        $category->title = $request->title;
        $category->eng_title = $engTitle;
        $category->description = $request->description;
        $category->save();

        return redirect('/admin/category')->with('status', 'Category updated!');
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


        return view('admin.categories.index', compact ('parentId', 'categories',  'categoriesCounter'));

    }

}
