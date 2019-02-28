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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/home',function(){
    return 'Aqui esta llegando';
});

Route::put('credential','Master\MasterController@credential');

Route::post('message','Master\MasterController@message');
Route::get('message/{id}','Master\MasterController@messageID')->where('id', '[0-9]+');
Route::get('message/{tag}','Master\MasterController@messageTag');

