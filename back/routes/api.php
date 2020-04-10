<?php

//use Illuminate\Http\Request;

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


Route::post('callback/create', 'CallbackController@create');
Route::get('image/{filename}','ImageController@image');
Route::get('logos','HomeController@logos');

Route::get('logos','LogoController@index');
Route::post('logos','LogoController@create');
Route::post('logos/delete/{id}','LogoController@delete');
Route::post('logos/update/{id}', 'LogoController@update');

Route::get('colors','ColorController@index');
Route::post('colors','ColorController@create');
Route::post('colors/delete/{id}','ColorController@delete');
Route::post('colors/update/{id}', 'ColorController@update');

Route::get('models','ModelController@index');
Route::post('models','ModelController@create');
Route::post('models/delete/{id}','ModelController@delete');
Route::post('models/update/{id}', 'ModelController@update');

Route::get('types','TypeController@index');
Route::post('types','TypeController@create');
Route::post('types/delete/{id}','TypeController@delete');
Route::post('types/update/{id}', 'TypeController@update');

Route::post('imagesUpload', 'ImageController@upload');
