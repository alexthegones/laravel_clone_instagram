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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// * Home
Route::get('/home', 'HomeController@index')->name('home');
// * Profile
Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
// * Post
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');
