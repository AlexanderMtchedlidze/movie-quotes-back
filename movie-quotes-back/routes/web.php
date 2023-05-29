<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\PasswordReset\ForgotPasswordController;
use App\Http\Controllers\PasswordReset\ResetPasswordController;
use App\Http\Controllers\Socialite\SocialiteGoogleController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [SessionController::class, 'login']);
Route::post('/logout', [SessionController::class, 'logout']);

Route::post('/register', RegisterController::class);
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->middleware(['signed'])->name('verification.verify');

Route::post('/forgot-password', ForgotPasswordController::class)->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'redirectWithToken'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google/redirect', [SocialiteGoogleController::class, 'handleRedirect']);
Route::get('/auth/google/callback', [SocialiteGoogleController::class, 'handleCallback']);
