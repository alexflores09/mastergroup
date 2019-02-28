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

Route::get('/', function () {
    return view('welcome');
});

Route::put('credential','Master\MasterController@credential');

Route::post('message','Master\MasterController@message');
Route::get('message/{id}','Master\MasterController@messageID')->where('id', '[0-9]+');
Route::get('message/{tag}','Master\MasterController@messageTag');
