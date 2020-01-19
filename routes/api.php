<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/card', 'CardController@get');
    Route::post('/card', 'CardController@create');
    Route::put('/card/{id}', 'CardController@update');
    Route::delete('/card/{id}', 'CardController@delete');
    // Route::options($uri, $callback);

});
