<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('comments/{post}','CommentController@apiIndex')->name('api.comments.index');

Route::get('comment/{post}','CommentController@apiProfile')->name('api.comment.profile');

Route::post('comments/{post}/{profile}','CommentController@apiStore')->name('api.comments.store');

Route::delete('comment/{comment}','CommentController@apiDestroy')->name('api.comments.destroy');
