<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
	Route::get('/user', [UserController::class, 'getUser']);
	Route::post('/logout', [SessionController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
	Route::post('/login', [SessionController::class, 'login']);
	Route::post('/register', RegisterController::class);
});
