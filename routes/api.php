<?php

use App\Album;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\PhotoResource;
use App\Photo;

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
Route::get('/photos', function () {
    return PhotoResource::collection(Photo::all());
});

Route::get('/photo/{id}', function ($id) {
    return new PhotoResource(Photo::find($id));
});

Route::get('/albums', function () {
    return AlbumResource::collection(Album::all());
});

Route::get('/album/{id}', function ($id) {
    return new AlbumResource(Album::find($id));
});
