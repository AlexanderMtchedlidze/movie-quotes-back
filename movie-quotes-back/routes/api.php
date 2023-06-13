<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\PasswordReset\ForgotPasswordController;
use App\Http\Controllers\PasswordReset\ResetPasswordController;
use App\Http\Controllers\Quote\CommentController;
use App\Http\Controllers\Quote\LikeController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\SearchController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::prefix('/user')->group(function () {
		Route::get('/', [UserController::class, 'getUser']);
		Route::post('/update', [UserController::class, 'updateUser']);
	});

	Route::get('/quotes', [QuoteController::class, 'getAllQuotes']);
	Route::post('/quote/add', [QuoteController::class, 'addQuote']);

	Route::prefix('/quote/{quote}')->group(function () {
		Route::post('/like', [LikeController::class, 'likeQuote']);
		Route::post('/comment', [CommentController::class, 'addComment']);
	});

	Route::prefix('/movies')->group(function () {
		Route::get('/', [MovieController::class, 'getAllMovies']);
		Route::post('/add', [MovieController::class, 'addMovie']);
		Route::get('/{user}', [MovieController::class, 'getUserMovies']);
		Route::get('/search/{query}', [MovieController::class, 'filterMovies']);
	});

	Route::get('/genres', [GenreController::class, 'getAllGenres']);
});
Route::prefix('/search')->group(function () {
	Route::get('/quotes/{query}', [SearchController::class, 'filterQuotes']);
	Route::get('/movies/{query}', [SearchController::class, 'filterMovies']);
});

Route::post('/login', [SessionController::class, 'login']);
Route::post('/logout', [SessionController::class, 'logout']);

Route::post('/register', RegisterController::class);
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->name('verification.verify');

Route::post('/forgot-password', ForgotPasswordController::class)->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google/redirect', [SocialiteGoogleController::class, 'handleRedirect']);
