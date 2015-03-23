<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    return redirect('home');
});

Route::get('home', 'HomeController@index');
Route::get('trending', 'HomeController@trending');

Route::get('{user}', 'UserController@show');
Route::get('{user}/favorites', 'UserController@showFavorites');
Route::get('{user}/followers', 'UserController@showFollowers');
Route::get('{user}/following', 'UserController@showFollowing');
Route::get('{user}/status/{id}', 'PostController@getShow');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'settings' => 'SettingsController',
    'subscribe' => 'SubscribeController',
    'post' => 'PostController',
    'repost' => 'RePostController',
    'message' => 'MessageController',
    'profile' => 'ProfileController'
]);
