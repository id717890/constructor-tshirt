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

Route::post('auth/login', 'AuthController@login');
Route::post('auth/reset', 'AuthController@resetEnv');

Route::get('sizes', 'SizeController@index');
Route::get('sizes/{color_id}', 'SizeController@get');
Route::get('number_sizes', 'NumberSizeController@index');
Route::get('text_sizes', 'TextSizeController@index');
Route::get('logo_sizes', 'LogoSizeController@index');
Route::get('logo_types', 'LogoTypeController@index');
Route::get('logos', 'LogoController@index');
Route::get('colors', 'ColorController@index');
Route::get('models', 'ModelController@index');
Route::get('types', 'TypeController@index');

Route::post('callback/mail', 'CallbackController@sendMail');
Route::post('callback/create', 'CallbackController@create');
Route::get('image/{filename}', 'ImageController@image');
//Route::get('logos','HomeController@logos');


Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('sizes', 'SizeController@create');
    Route::post('sizes/delete/{id}', 'SizeController@delete');
    Route::post('sizes/update/{id}', 'SizeController@update');

    Route::post('number_sizes', 'NumberSizeController@create');
    Route::post('number_sizes/delete/{id}', 'NumberSizeController@delete');
    Route::post('number_sizes/update/{id}', 'NumberSizeController@update');

    Route::post('text_sizes', 'TextSizeController@create');
    Route::post('text_sizes/delete/{id}', 'TextSizeController@delete');
    Route::post('text_sizes/update/{id}', 'TextSizeController@update');

    Route::post('logo_sizes', 'LogoSizeController@create');
    Route::post('logo_sizes/delete/{id}', 'LogoSizeController@delete');
    Route::post('logo_sizes/update/{id}', 'LogoSizeController@update');

    Route::post('logo_types', 'LogoTypeController@create');
    Route::post('logo_types/delete/{id}', 'LogoTypeController@delete');
    Route::post('logo_types/update/{id}', 'LogoTypeController@update');

    Route::post('logos', 'LogoController@create');
    Route::post('logos/delete/{id}', 'LogoController@delete');
    Route::post('logos/update/{id}', 'LogoController@update');

    Route::post('colors', 'ColorController@create');
    Route::post('colors/delete/{id}', 'ColorController@delete');
    Route::post('colors/update/{id}', 'ColorController@update');

    Route::post('models', 'ModelController@create');
    Route::post('models/delete/{id}', 'ModelController@delete');
    Route::post('models/update/{id}', 'ModelController@update');

    Route::post('types', 'TypeController@create');
    Route::post('types/delete/{id}', 'TypeController@delete');
    Route::post('types/update/{id}', 'TypeController@update');

    Route::post('imagesUpload', 'ImageController@upload');

});






