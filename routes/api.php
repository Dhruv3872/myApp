<?php

use App\Http\Controllers\ProcessDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// To save a secret:
Route::post('/saveAuthenticationDetails', [ProcessDataController::class, 'saveAuthenticationDetails']);

Route::post('/data', [ProcessDataController::class, 'processData']);
