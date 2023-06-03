<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PasswordReset\ForgotPasswordController;
use App\Http\Controllers\PasswordReset\ResetPasswordController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Socialite\SocialiteGoogleController;
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

	Route::prefix('/quote/{id}')->group(function () {
		Route::post('/like', [LikeController::class, 'likeQuote']);
		Route::post('/comment', [CommentController::class, 'addComment']);
	});
});

Route::post('/login', [SessionController::class, 'login']);
Route::post('/logout', [SessionController::class, 'logout']);

Route::post('/register', RegisterController::class);
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->name('verification.verify');

Route::post('/forgot-password', ForgotPasswordController::class)->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google/redirect', [SocialiteGoogleController::class, 'handleRedirect']);
Route::get('/auth/google/callback', [SocialiteGoogleController::class, 'handleCallback']);

Route::get('/quotes', [QuoteController::class, 'getAllQuotes']);
