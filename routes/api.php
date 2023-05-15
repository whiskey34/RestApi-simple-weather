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


// for documentation openAPI/swagger







// endpoint API
Route::group(['prefix' => 'weather'], function () {
    Route::get('/', [WeatherController::class, 'index']);
    Route::get('/{id}', [WeatherController::class, 'show']);
    Route::post('/', [WeatherController::class, 'store']);
    Route::put('/update/{id}', [WeatherController::class, 'update']);
    Route::delete('/delete/{id}', [WeatherController::class, 'destroy']);
});

// route for location
Route::get('/location', [WeatherController::class, 'indexLocation']);
Route::get('/location/{id}', [WeatherController::class, 'showLocation']);
Route::post('/location', [WeatherController::class, 'storeLocation']);
Route::put('/location/{id}', [WeatherController::class, 'updateLocation']);
Route::delete('/location/{id}', [WeatherController::class, 'destroyLocation']);


// route for the forecast
Route::get('/forecast', [WeatherController::class, 'indexForecast']);
Route::get('/forecast/show/{id}', [WeatherController::class, 'showForecast']);
Route::post('/forecast/add-new', [WeatherController::class, 'storeForecast']);
Route::put('/forecast/update/{id}', [WeatherController::class, 'updateForecast']);
Route::delete('/forecast/delete/{id}', [WeatherController::class, 'destroyForecast']);
