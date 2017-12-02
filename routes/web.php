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
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');


Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
