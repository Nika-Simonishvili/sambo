<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\auth\LoginController;

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

Route::post('login', [LoginController::class ,'login']);

Route::get('/coaches', [CoachController::class, 'index']);
Route::post('coach-store', [CoachController::class, 'store'])->middleware(['auth:sanctum', 'can:manage coach']);

Route::get('referees', [RefereeController::class, 'index']);
Route::post('referee-store', [RefereeController::class, 'store'])->middleware(['auth:sanctum', 'can:manage referee']);

Route::get('athletes', [AthleteController::class, 'index']);
Route::post('athlete-store', [AthleteController::class, 'store'])->middleware(['auth:sanctum', 'can:manage athlete']);
