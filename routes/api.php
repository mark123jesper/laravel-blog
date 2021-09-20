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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::resource('/question', 'QuestionController');
Route::resource('/category', 'CategoryController');

Route::resource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@like');
Route::delete('/like/{reply}', 'LikeController@unlike');


// Route::post('/notifications', function(){
//     return [
//         'read' => auth()->user()->readNotifications(),
//         'unread' => auth()->user()->unreadNotifications(),
//         'console' => auth()->user()
//     ];
// });


// Route::get('/notifications', function(){
//     return [
//         // 'read' => auth()->user()->readNotifications(),
//         // 'unread' => auth()->user->unreadNotifications(),
//         'console' => auth()->user()
//     ];
// });

Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');
