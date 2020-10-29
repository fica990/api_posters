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

Route::apiResource('images', 'ImageController');

Route::apiResource('albums', 'AlbumController');

Route::post('/images/{id}/poster', 'PosterController@store')->name('images.poster');

Route::post('/filesystem/{bucket}/{filePath?}', 'FilesystemController@upload')
    ->where('filePath', '(.*)');
