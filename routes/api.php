<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\auth\AuthController;

// check middlewares in controllers
// login  route
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});

// coach routes
Route::controller(CoachController::class)->group(function () {
    Route::get('coaches', 'index');
    Route::get('coaches/{id}', 'show');
    Route::get('coaches/{id}/getAthletes', 'getAthletes');
    Route::post('coach-store', 'store');
    Route::delete('coach/{id}', 'destroy');
});


// athlete routes
Route::controller(AthleteController::class)->group(function () {
    Route::get('athletes', 'index');
    Route::get('athletes/{id}', 'show');
    Route::post('athlete-store',  'store');
    Route::delete('athlete/{id}', 'destroy');
});


// referee routes
Route::controller(RefereeController::class)->group(function () {
    Route::get('referees', 'index');
    Route::get('referee/{id}', 'show');
    Route::put('referee/{id}/edit', 'update');
    Route::post('referee-store', 'store');
    Route::delete('referee/{id}', 'destroy');
});

// tournament routes
Route::get('tournament', [TournamentController::class, 'index']);
Route::post('tournament-store', [TournamentController::class, 'store']);

