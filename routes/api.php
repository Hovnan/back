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

Route::group(['middleware' => 'auth:api'], function () {
    // Route::get('markers', ['as' => 'markers', 'uses' => 'MarkerController@index']);
    // Route::post('markers/store', ['as' => 'markers.store', 'uses' => 'MarkerController@store']);
    Route::resource('markers', 'MarkerController');
});

Route::post('register','Auth\RegisterController@create');
