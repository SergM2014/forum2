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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'CategoryController@all');
Route::get('/category/{category}', 'CategoryController@show');

Route::get('/topic/{topic}', 'TopicController@show');

Route::get('/response/{response}', 'ResponseController@show');
Route::get('/member/exit',  'MemberController@leave');
Route::post('/member/store', 'MemberController@store');
Route::get('/member/{member}', 'MemberController@show');
Route::get('/signUp', 'MemberController@create');



Route::post('/images/uploadAvatar', 'ImagesController@uploadAvatar');
Route::post('/images/deleteAvatar', 'ImagesController@deleteAvatar');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
