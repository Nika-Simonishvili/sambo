<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\auth\AuthController;

// login  route
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

// coach routes
Route::middleware(['auth:sanctum', 'can:manage coach'])->group(function () {
    Route::post('coach-store', [CoachController::class, 'store']);
    Route::delete('coach/{id}', [CoachController::class, 'destroy']);
});
Route::get('coaches', [CoachController::class, 'index']);
Route::get('coaches/{id}', [CoachController::class, 'show']);
Route::get('coaches/{id}/getAthletes', [CoachController::class, 'getAthletes']);

// athlete routes
Route::middleware(['auth:sanctum', 'can:manage athlete'])->group(function () {
    Route::post('athlete-store',  [AthleteController::class, 'store']);
    Route::delete('athlete/{id}', [AthleteController::class, 'destroy']);
});
Route::get('athletes', [AthleteController::class, 'index']);
Route::get('athletes/{id}', [AthleteController::class, 'show']);

// referee routes
Route::middleware(['auth:sanctum', 'can:manage referee'])->group(function () {
    Route::put('referee/{id}/edit', [RefereeController::class, 'update']);
    Route::post('referee-store', [RefereeController::class, 'store']);
    Route::delete('referee/{id}', [RefereeController::class, 'destroy']);
});
Route::get('referees', [RefereeController::class, 'index']);
Route::get('referee/{id}', [RefereeController::class, 'show']);

// tournament routes
Route::middleware(['auth:sanctum', 'can:manage tournament'])->group(function () {
    Route::post('tournament-store', [TournamentController::class, 'store']);
});
Route::get('tournaments', [TournamentController::class, 'index']);
Route::get('tournament/{id}', [TournamentController::class, 'show']);
Route::post('tournament/{id}/addAthletes', [TournamentController::class, 'addAthleteOnTournament'])->middleware(['auth:sanctum', 'can:manage athlete', ]);
