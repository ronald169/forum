<?php

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
Route::post('threads', 'ThreadController@store'); //->middleware('must-be-confirmed');

//Route::patch('threads/{channel}/{thread}', 'ThreadController@update');
Route::post('locked-threads/{thread}', 'LockedThreadController@store')->middleware('admin');
Route::delete('locked-threads/{thread}', 'LockedThreadController@destroy')->middleware('admin');

//  Event
Route::post('events/', 'EventController@store');

// Community Link
Route::get('communities/', 'CommunityLinkController@index');
Route::get('communities/{channel}', 'CommunityLinkController@index');
Route::post('communities', 'CommunityLinkController@store');

//  Courses

Route::get('courses', 'CourseController@index');
Route::post('courses', 'CourseController@store');
Route::get('courses/{klass}/{course}', 'CourseController@show');
Route::put('courses/{klass}/{course}', 'CourseController@update');
Route::delete('courses/{klass}/{course}', 'CourseController@destroy');
Route::get('courses/create', 'CourseController@create');
Route::get('courses/{betreuung}', 'CourseController@index');

//Class
Route::get('klasse', 'BetreuungController@index');
Route::post('klasse', 'BetreuungController@store');
Route::get('klasse/{klass}', 'BetreuungController@show');
Route::put('klasse/{klass}', 'BetreuungController@update');
Route::delete('klasse/{klass}', 'BetreuungController@destroy');


//  Comment
Route::get('courses/{klass}/{course}/comments', 'CourseCommentController@index');
Route::post('courses/{klass}/{course}/comments', 'CourseCommentController@store');
Route::delete('courses/{klass}/{course}/comments/{comment}', 'CourseCommentController@destroy');

//Subscription Thread
Route::post('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@store');
Route::delete('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@destroy');

// Subscription Class
Route::post('klasse/{klass}/subscriptions', 'ClassSubscriptionController@store');
Route::delete('klasse/{klass}/subscriptions', 'ClassSubscriptionController@destroy');

Route::delete('replies/{reply}', 'ReplyController@destroy');
Route::put('replies/{reply}', 'ReplyController@update');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::get('threads/{channel}/{thread}/replies', 'ReplyController@index');

        //Reply Favorite
Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy');

        //Course Favorite
Route::post('courses/{klass}/{course}/favorites', 'CourseFavoriteController@store');
Route::delete('courses/{klass}/{course}/favorites', 'CourseFavoriteController@destroy');

        //Link Favorite
Route::post('communities/{link}/favorites', 'LinkFavoriteController@store');
Route::delete('communities/{link}/favorites', 'LinkFavoriteController@destroy');

        //User
Route::get('@ {user}', 'ProfileController@show');

Route::get('profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

Route::get('users', 'UserController@index');

Route::post('users/{user}/avatar', 'UserAvatarController@store');

Route::post('replies/{reply}/best', 'BestReplyController@store');

//Route::get('mali', function () {
//    return auth()->user()->notify(new VerifyEmail);
//});

