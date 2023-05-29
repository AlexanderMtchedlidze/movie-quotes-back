<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\SocialiteGoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->middleware(['signed'])->name('verification.verify');

Route::get('/auth/google/redirect', [SocialiteGoogleController::class, 'handleRedirect']);

Route::get('/auth/google/callback', [SocialiteGoogleController::class, 'handleCallback']);
