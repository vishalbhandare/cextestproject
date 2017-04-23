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



Route::get('/', 'HomeController@index');
Route::get('images/{image}', function($image = null)
{
    $path = storage_path().'/app/images/' . $image;

    if (file_exists($path)) { 
        return Response::download($path);
    }
});
Route::resource('profiles','ProfileController');