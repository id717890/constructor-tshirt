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
Route::get('/doc1', 'HomeController@doc1');
Route::get('/doc2', 'HomeController@doc2');
Route::get('/doc3', 'HomeController@doc3');
Route::get('/doc4', 'HomeController@doc4');
//Route::get('/', function() {
//    return "Cache is cleared";
//});

Route::get('/print-pdf', 'HomeController@printPDF');



//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
//Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');

//Route::get('/clear-cache', function() {
//    Artisan::call('cache:clear');
//    return "Cache is cleared";
//});
