<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('webmotors')->group(function () {
    Route::post('update-listing', [CarController::class, 'updateWebMotors']);
});
Route::prefix('revendamais')->group(function () {
    Route::post('update-listing', [CarController::class, 'updateRendaMais']);
});
Route::prefix('cars')->group(function () {
    Route::post('reset', [CarController::class, 'truncateCars']);
    Route::post('reload', [CarController::class, 'getAllCars']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
