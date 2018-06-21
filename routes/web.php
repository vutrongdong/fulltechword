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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login-with-social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Router for SSR Vue app
Route::get('/admin', 'ProfileController@index')->name('profile');
Route::get('/admin/{any}', 'ProfileController@index')->where('any', '.*');

