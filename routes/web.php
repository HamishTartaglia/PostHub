<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts','PostController@index')->name('posts.index');

Route::get('posts/{post}', 'PostController@show')->name('posts.show');

Route::get('profiles','ProfileController@index')->name('profiles.index');

Route::get('profiles/{profile}', 'ProfileController@show')->name('profiles.show');