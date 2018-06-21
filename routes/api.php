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



Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/roles', 'RoleController');
    Route::get('/permissions', 'PermissionController@index');
    Route::get('/setting', 'SettingController@show');
    Route::put('/setting', 'SettingController@update')->middleware('can:config-site, App\User');
    Route::get('/cities', 'CityController@index');
    Route::get('/districts/city/{id}', 'DistrictController@getByCity');
});
