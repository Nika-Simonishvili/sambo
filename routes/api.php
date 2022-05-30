<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\auth\LoginController;

// login  route
Route::post('login', [LoginController::class ,'login']);

// coach routes
Route::controller(CoachController::class)->middleware(['auth:sanctum', 'can:manage coach'])->group(function () {
    Route::get('coaches', [CoachController::class, 'index'])->withoutMiddleware(['auth:sanctum', 'can:manage coach']);
    Route::post('coach-store','store');
    Route::delete('coach/{id}','destroy');
});


// athlete routes
Route::controller(AthleteController::class)->middleware(['auth:sanctum', 'can:manage athlete'])->group(function () {
    Route::get('athletes','index')->withoutMiddleware(['auth:sanctum', 'can:manage athlete']);
    Route::post('athlete-store','store');
    Route::delete('athlete/{id}', 'destroy');
});


// referee routes
Route::controller(RefereeController::class)->middleware(['auth:sanctum', 'can:manage referee'])->group(function () {
    Route::get('referees','index')->withoutMiddleware(['auth:sanctum', 'can:manage referee']);
    Route::post('referee-store','store');
    Route::delete('referee/{id}','destroy');
});