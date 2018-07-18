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

Route::group(['prefix' => 'v1'], function(){
    Route::get('test','Api\ApiController@test');
    Route::get('{resource}','Api\ApiController@getCollection');
    Route::get('{resource}/{id}', 'Api\ApiController@getItem');
    Route::delete('{resource}/{id}', 'Api\ApiController@deleteItem');
    Route::post('{resource}', 'Api\ApiController@createItem');
    Route::post('{resource}/{id}', 'Api\ApiController@updateItem');
});
