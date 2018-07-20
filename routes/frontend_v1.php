<?php

Route::get('/', 'HomeController@index')->name('v1.home');
Route::get('/{slug}', 'HomeController@detail')->name('v1.detail');
Route::get('/category/{slug}', 'HomeController@category')->name('v1.category');
