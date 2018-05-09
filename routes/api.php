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

use App\Mail\SendEmailMailable;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Mail;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('markers', 'MarkerController');
    Route::resource('products', 'ProductController');
});

Route::post('register','Auth\RegisterController@create');
Route::get('event', function() {
//    event(new \App\Events\TaskEvent('Hey how are you'));
    $i = 016;
    echo $i / 2;
});
Route::get('send-email', function() {
    SendEmailJob::dispatch()->delay(now()->addSeconds(5));
//    Mail::to('vebo@stelliteop.info')->send(new SendEmailMailable());
//    dd(Config::get('mail'));
});