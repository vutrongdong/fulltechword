<?php

Route::get('/', 'HomeControllerV2@index');
Route::get('detail/{id}/{slug}', 'HomeControllerV2@details');
Route::get('category/{id}/{slug}', 'HomeControllerV2@Category');
Route::get('search', 'HomeControllerV2@Search');
?>
