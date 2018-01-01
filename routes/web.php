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


Route::get('/', 'PostsController@index');
Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::post('/posts', 'PostsController@store')->name('posts.store');
Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
Route::get('/posts/{id}', 'PostsController@show')->name('posts.show');

Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');

Route::get('/adminposts', 'AdminPostsController@index')->name('adminposts.index');
Route::get('/adminposts/{post}', 'AdminPostsController@show')->name('adminposts.show');
Route::get('/adminposts/{post}/edit', 'AdminPostsController@edit')->name('adminposts.edit');
Route::patch('/adminposts/{post}', 'AdminPostsController@update')->name('adminposts.update');
Route::patch('/adminposts/publish/{post}', 'AdminPostsController@publish')->name('adminposts.publish');
Route::patch('/adminposts/unpublish/{post}', 'AdminPostsController@unpublish')->name('adminposts.unpublish');
Route::delete('/adminposts/{post}', 'AdminPostsController@destroy')->name('adminposts.destroy');

Auth::routes();
