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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@construct');//gestのログアウト

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/register', 'Auth\RegisterController@validator');//バリテーション

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/post','PostsController@post');
Route::post('/update','PostsController@update');
Route::get('/post/{id}/delete','PostsController@delete');
Route::get('/profile','UsersController@profile');
Route::post('/up-profile','UsersController@update');
Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');
Route::get('/follows/{id}/create','FollowsController@create');
Route::get('/follows/{id}/delete','FollowsController@delete');
Route::get('/follows/{id}/profile','FollowsController@profile');
Route::get('/follow-list','UsersController@followList');
Route::get('/follower-list','UsersController@followerList');
Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('')
