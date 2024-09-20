<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// scoresのCRUDのルーティング
Route::get('/scores', 'App\Http\Controllers\ScoreController@index');
Route::post('/score', 'App\Http\Controllers\ScoreController@store');
Route::get('/score/{score:id}', 'App\Http\Controllers\ScoreController@edit');
Route::patch('/score/{score:id}', 'App\Http\Controllers\ScoreController@update');
Route::delete('/score/{score:id}', 'App\Http\Controllers\ScoreController@destroy');
