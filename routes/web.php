<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'cars' => CarController::getAllCars()
    ]);
});

require __DIR__.'/auth.php';
