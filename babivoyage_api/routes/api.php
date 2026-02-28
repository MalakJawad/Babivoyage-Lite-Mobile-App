<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\FlightController;


Route::get('/health', fn() => response()->json(['status' => 'ok']));

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
});

Route::get('/airports', [AirportController::class, 'index']);
Route::get('/airports/search', [FlightController::class, 'airportSearch']);

Route::post('/flights/search', [FlightController::class, 'search']);
Route::post('/flights/details', [FlightController::class, 'details']);

Route::post('/bookings', [FlightController::class, 'createBooking']);