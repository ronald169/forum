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

use Illuminate\Auth\Notifications\VerifyEmail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

    //Thread
Route::get('threads', 'ThreadController@index');
Route::get('threads/create', 'ThreadController@create');
Route::get('threads/search', 'SearchController@show');
Route::get('threads/{channel}', 'ThreadController@index');
Route::get('threads/{channel}/{thread}', 'ThreadController@show');
Route::put('threads/{channel}/{thread}', 'ThreadController@update');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');
Route::post('threads', 'ThreadController@store')->middleware('must-be-confirmed');

//Route::patch('threads/{channel}/{thread}', 'ThreadController@update');
Route::post('locked-threads/{thread}', 'LockedThreadController@store')->middleware('admin');
Route::delete('locked-threads/{thread}', 'LockedThreadController@destroy')->middleware('admin');

    //Subscription
Route::post('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@store');
Route::delete('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@destroy');

Route::delete('replies/{reply}', 'ReplyController@destroy');
Route::put('replies/{reply}', 'ReplyController@update');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::get('threads/{channel}/{thread}/replies', 'ReplyController@index');

        //Favorites
Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('@ {user}', 'ProfileController@show');

Route::get('profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

Route::get('users', 'UserController@index');

Route::post('users/{user}/avatar', 'UserAvatarController@store');

Route::post('replies/{reply}/best', 'BestReplyController@store');

//Route::get('mali', function () {
//    return auth()->user()->notify(new VerifyEmail);
//});
