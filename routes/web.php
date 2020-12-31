<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\CommentAdded;
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

Route::get('/', 'PostController@index');

Route::get('profiles','ProfileController@index')->name('profiles.index');

Route::get('profiles/{profile}', 'ProfileController@show')->name('profiles.show');

Route::get('categories', 'CategoryController@index')->name('categories.index');

Route::get('categories/{category}/newest','CategoryController@newest')->name('categories.show.newest');

Route::get('categories/{category}/oldest','CategoryController@oldest')->name('categories.show.oldest');

Route::get('categories/{category}/top','CategoryController@top')->name('categories.show.top');

Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');

Route::get('posts','PostController@index')->name('posts.index');

Route::get('categories/{category}/create','PostController@create')->name('post.create')->middleware('can:create,App\Post');

Route::post('posts/{category}','PostController@store')->name('post.store')->middleware('can:create,App\Post');

Route::get('categories/{category}/{post}', 'PostController@show')->name('posts.show');

Route::get('comments', 'CommentController@index')->name('comments.index');

Route::post('comment/{post}','CommentController@store')->name('comment.store')->middleware('can:create,App\Comment');

Route::delete('posts/{post}','PostController@destroy')->name('post.destroy')->middleware('can:delete,post');

Route::delete('comments/{comment}','CommentController@destroy')->name('comment.destroy')->middleware('can:delete,comment');

Route::delete('profiles/{profile}','ProfileController@destroy')->name('profile.destroy')->middleware('can:delete,profile');

Route::delete('photo/{photo}','PhotoController@destroy')->name('photo.destroy');

Route::get('categories/{category}/{post}/edit','PostController@edit')->name('post.edit')->middleware('can:update,post');

Route::put('categories/{category}/{post}', 'PostController@update')->name('post.update')->middleware('can:update,post');

Route::get('comments/{comment}/edit','CommentController@edit')->name('comment.edit')->middleware('can:update,comment');

Route::put('comments/{comment}', 'CommentController@update')->name('comment.update')->middleware('can:update,comment');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'ProfileController@logout')->name('logout');

Route::get('profiles/{profile}/edit','ProfileController@edit')->name('profile.edit')->middleware('can:update,profile');

Route::put('profiles/{profile}', 'ProfileController@update')->name('profile.update')->middleware('can:update,profile');



Route::get('event',function(){
    event(new CommentAdded(Auth::id(),Auth::id()));
});