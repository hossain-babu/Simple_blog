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

Route::get('/','HelloController@index');

Route::get('contat/us','HelloController@index' )->name('contact');
Route::get('about/us', 'HelloController@about')->name('about');
Route::get('student/list','HelloController@student')->name('student');
// Route::get('/', 'HelloController@home')->name('home');
// Category field is here=========
Route::get('add/category', 'AddCategory@add')->name('add.category');
Route::POST('store/category','AddCategory@storecat')->name('store.category');
Route::get('all/category','AddCategory@showall')->name('all.category');
Route::get('view/category/{id}','AddCategory@viewcategory');
Route::get('delete/category/{id}','AddCategory@deletecategory');
Route::get('edit/category/{id}','AddCategory@editCategory');
Route::post('update/category/{id}','AddCategory@updateCategory');
// Post Field is here
Route::get('write/post','postController@write')->name('write.post');
Route::POST('store/post','postController@storepost')->name('store.post');
Route::get('all/post','PostController@allpost')->name('all.post');
Route::get('view/post/{id}','PostController@viewpost')->name('view.post');
Route::get('edit/post/{id}','PostController@editpost');
Route::post('update/post/{id}','PostController@updatepost');
Route::get('delete/post/{id}','PostController@deletepost');