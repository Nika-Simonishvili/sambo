<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\auth\LoginController;

// login  route
Route::post('login', [LoginController::class ,'login']);

// coach routes
Route::middleware(['auth:sanctum', 'can:manage coach'])->group(function () {
    Route::post('coach-store',[CoachController::class, 'store']);
    Route::delete('coach/{id}',[CoachController::class, 'destroy']);
});
Route::get('coaches', [CoachController::class, 'index']);
Route::get('coaches/{id}', [CoachController::class, 'show']);


// athlete routes
Route::controller(AthleteController::class)->middleware(['auth:sanctum', 'can:manage athlete'])->group(function () {
    Route::get('athletes','index')->withoutMiddleware(['auth:sanctum', 'can:manage athlete']);
    Route::get('athletes/{id}','show')->withoutMiddleware(['auth:sanctum', 'can:manage athlete']);
    Route::post('athlete-store','store');
    Route::delete('athlete/{id}', 'destroy');
});


// referee routes
Route::middleware(['auth:sanctum', 'can:manage referee'])->group(function () {
    Route::post('referee-store',[RefereeController::class, 'store']);
    Route::delete('referee/{id}',[RefereeController::class, 'destroy']);
});
Route::get('referees',[RefereeController::class, 'index']);
Route::get('referees/{id}',[RefereeController::class, 'show']);
