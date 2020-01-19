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

Route::post('/user/login', 'ApiTokenController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('/card', 'CardController@get');
    Route::post('/card', 'CardController@create');
    Route::put('/card/{id}', 'CardController@update');
    Route::delete('/card/{id}', 'CardController@delete');

    Route::get('/deck', 'DeckController@get');
    Route::post('/deck', 'DeckController@create');
    Route::put('/deck/{id}', 'DeckController@update');
    Route::delete('/deck/{id}', 'DeckController@delete');

    Route::get('/game', 'GameController@get');
    Route::post('/game', 'GameController@create');
    // Route::put('/game/{id}', 'GameController@update');
    // Route::delete('/game/{id}', 'GameController@delete');
});
