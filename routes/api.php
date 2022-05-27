<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [\App\Http\Controllers\auth\LoginController::class ,'login']);

Route::get('/coaches', [\App\Http\Controllers\CoachController::class, 'index'])->middleware('auth:sanctum');
Route::post('coach-store', [\App\Http\Controllers\CoachController::class, 'store'])->middleware(['auth:sanctum', 'can:manage coach']);
