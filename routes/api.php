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

Route::post('/user', 'ApiTokenController@register');
Route::post('/user/login', 'ApiTokenController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response([
        'response' => $request->user()
    ], 201);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/card', 'CardController@get');
    Route::get('/card/{id}', 'CardController@get');
    Route::post('/card', 'CardController@create');
    Route::put('/card/{id}', 'CardController@update');
    Route::delete('/card/{id}', 'CardController@delete');

    Route::get('/deck', 'DeckController@get');
    Route::get('/deck/{id}', 'DeckController@get');
    Route::post('/deck', 'DeckController@create');
    Route::put('/deck/{id}', 'DeckController@update');
    Route::delete('/deck/{id}', 'DeckController@delete');
});
