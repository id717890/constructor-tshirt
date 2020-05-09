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

Route::post('export/catalog', 'ExportController@exportCatalog');
Route::post('import/sizes', 'ExportController@importSizes');
Route::post('export/sizes', 'ExportController@exportSizes');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/reset', 'AuthController@resetEnv');

Route::get('pages/{id}', 'PageController@single');
Route::get('pages', 'PageController@index');
Route::get('feedbacks', 'FeedbackController@index');
Route::post('feedbacks', 'FeedbackController@create');
Route::get('photos', 'PhotoController@index');
Route::get('videos', 'VideoController@index');
Route::get('news', 'NewsController@index');
Route::get('discounts', 'DiscountController@index');
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

Route::post('callback/correspondent', 'CallbackController@correspondent');
Route::post('callback/callme', 'CallbackController@callMe');
Route::post('callback/idea', 'CallbackController@sendIdea');
Route::post('callback/mail', 'CallbackController@sendMail');
Route::post('callback/create', 'CallbackController@create');
Route::get('image/{filename}', 'ImageController@image');
//Route::get('logos','HomeController@logos');


Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('pages/update/{id}', 'PageController@update');

    Route::post('feedbacks/delete/{id}', 'FeedbackController@delete');
    Route::post('feedbacks/update/{id}', 'FeedbackController@update');

    Route::post('photos', 'PhotoController@create');
    Route::post('photos/delete/{id}', 'PhotoController@delete');
    Route::post('photos/update/{id}', 'PhotoController@update');

    Route::post('videos', 'VideoController@create');
    Route::post('videos/delete/{id}', 'VideoController@delete');
    Route::post('videos/update/{id}', 'VideoController@update');

    Route::post('news', 'NewsController@create');
    Route::post('news/delete/{id}', 'NewsController@delete');
    Route::post('news/update/{id}', 'NewsController@update');

    Route::post('discounts', 'DiscountController@create');
    Route::post('discounts/delete/{id}', 'DiscountController@delete');
    Route::post('discounts/update/{id}', 'DiscountController@update');

    Route::post('sizes', 'SizeController@create');
    Route::post('sizes/delete/{id}', 'SizeController@delete');
    Route::post('sizes/update/{id}', 'SizeController@update');
    Route::post('sizes/updateprices/{id}', 'SizeController@updateprices');

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






