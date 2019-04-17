<?php

use Illuminate\Http\Request;

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

Route::post('posts/{post}', 'PostController@update');
Route::delete('posts/{post}', 'PostController@destroy');
Route::put('posts', 'PostController@store');

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@authenticate');
Route::get('/refresh', 'AuthController@refresh');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'AuthController@getAuthenticatedUser');
    Route::get('posts', 'PostController@index');
    Route::get('posts/{post}', 'PostController@show');
    Route::get('posts/{id}/like', 'LikeController@likePost');
    Route::get('posts/{id}/dislike', 'LikeController@dislikePost');
    Route::get('posts/{id}/unlike', 'LikeController@unlikePost');
    Route::get('posts/{id}/undislike', 'LikeController@undislikePost');
    Route::post('posts/{post}/comment', 'CommentController@store');
    Route::get('posts/{post}/comments', 'CommentController@poll');
//    Route::get('closed', 'DataController@closed');
});