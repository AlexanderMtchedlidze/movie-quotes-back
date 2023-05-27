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
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->middleware(['signed'])->name('verification.verify');

Route::middleware('guest')->group(function () {
	Route::post('/forgot-password', ForgotPasswordController::class)->name('password.email');
	Route::get('/reset-password/{token}', [ResetPasswordController::class, 'redirectWithToken'])->name('password.reset');
});
