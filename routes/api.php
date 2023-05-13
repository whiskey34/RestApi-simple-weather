<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/weather/{id}/forecast', [WeatherController::class, 'getForecast']);

Route::get('/weather', [WeatherController::class, 'index']);
Route::get('/weather/{id}', [WeatherController::class, 'show']);
Route::post('/weather', [WeatherController::class, 'store']);
Route::put('/weather/{id}', [WeatherController::class, 'update']);
Route::delete('/weather/{id}', [WeatherController::class, 'destroy']);

// route for location
Route::get('/location', [WeatherController::class, 'indexLocation']);
Route::get('/location/{id}', [WeatherController::class, 'showLocation']);
Route::post('/location', [WeatherController::class, 'storeLocation']);
Route::put('/location/{id}', [WeatherController::class, 'updateLocation']);
Route::delete('/location/{id}', [WeatherController::class, 'destroyLocation']);
