<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'CategoryController@all');
Route::get('/category/{category}', 'CategoryController@show');

Route::get('/topic/{topic}', 'TopicController@show');



Route::get('/response/{response}', 'ResponseController@show');
Route::get('/member/exit',  'MemberController@leave');
Route::post('/member/store', 'MemberController@store');
Route::post('/member/login', 'MemberController@login');
Route::get('/member/{member}', 'MemberController@show');
Route::get('/member/{member}/edit', 'MemberController@edit');
Route::post('/member/{member}/update', 'MemberController@update');
Route::get('/signUp', 'MemberController@create');
Route::get('/signIn', 'MemberController@signIn');


Route::group(['middleware' => 'member'], function () {

    Route::post('/response/like','LikeController@addLike');
    Route::post('/response/dislike','LikeController@addDislike');

    Route::post('/response/store', 'ResponseController@store');
    Route::post('/response/showResponseToComment', 'ResponseController@showResponseToComment');



});

Route::post('search', 'SearchController@showPreview');



Route::post('/images/uploadAvatar', 'ImagesController@uploadAvatar');
Route::post('/images/deleteAvatar', 'ImagesController@deleteAvatar');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix'=>'admin'], function(){

    Route::get('/', function () { return view('admin.index');});
//show admin category popupmenu
    Route::post('/popup/category/{category}', function($category){return view('admin.popup.category', compact('category'));});


    Route::get('/category', 'CategoryController@adminCategories');
    Route::get('/category/create', 'CategoryController@create');
    Route::post('/category/store', 'CategoryController@store');
    Route::get('/category/{category}/edit', 'CategoryController@edit');
    Route::put('/category/{category}', 'CategoryController@update');
    Route::delete('/category/{category}', 'CategoryController@destroy');

    Route::get('/category/{category}', 'CategoryController@adminCategories');


    Route::get('topic', 'TopicController@index');

});
