<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\NotificationController\NotificationController;
use App\Http\Controllers\PasswordReset\ForgotPasswordController;
use App\Http\Controllers\PasswordReset\ResetPasswordController;
use App\Http\Controllers\Quote\CommentController;
use App\Http\Controllers\Quote\LikeController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\SearchController\SearchController;
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
});

Route::post('/get-email-verification/{email}', [UserController::class, 'getEmailVerification'])->name('user.get-email-verification');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::post('/user/update', [UserController::class, 'updateUser'])->name('user.update-user');

	Route::get('/quotes', [QuoteController::class, 'getAllQuotes'])->name('quote.get-all-quotes');
	Route::post('/quote/add', [QuoteController::class, 'addQuote'])->name('quote.add-quote');

	Route::prefix('/quote/{quote}')->group(function () {
		Route::get('/', [QuoteController::class, 'getQuote'])->name('quote.get-quote');
		Route::post('/like', [LikeController::class, 'likeQuote'])->name('like.like-quote');
		Route::post('/unlike', [LikeController::class, 'unlikeQuote'])->name('like.unlike-quote');
		Route::post('/comment', [CommentController::class, 'addComment'])->name('comment.add-comment');
		Route::post('/delete', [QuoteController::class, 'deleteQuote'])->name('quote.delete-quote');
		Route::post('/edit', [QuoteController::class, 'editQuote'])->name('quote.edit-quote');
	});

	Route::prefix('/movie/{movie}')->group(function () {
		Route::get('/', [MovieController::class, 'getMovie'])->name('movie.get-movie');
		Route::post('/delete', [MovieController::class, 'deleteMovie'])->name('movie.delete-movie');
		Route::post('/edit', [MovieController::class, 'editMovie'])->name('movie.edit-movie');
	});

	Route::prefix('/movies')->group(function () {
		Route::get('/', [MovieController::class, 'getAllMovies'])->name('movie.get-all-movies');
		Route::post('/add', [MovieController::class, 'addMovie'])->name('movie.add-movie');
		Route::get('/{user}', [MovieController::class, 'getUserMovies'])->name('movie.get-user-movies');
	});

	Route::get('/genres', [GenreController::class, 'getAllGenres'])->name('genre.get-all-genres');

	Route::prefix('/search')->group(function () {
		Route::get('/quotes/{query}', [QuoteController::class, 'filterQuotes'])->name('quote.filter-quotes');
		Route::get('/movies/{query}', [MovieController::class, 'filterQuotes'])->name('movie.quotes-filter');
		Route::get('/all/{query}', SearchController::class)->name('search.all');
	});

	Route::prefix('/notifications')->group(function () {
		Route::get('/', [NotificationController::class, 'getAllNotifications'])->name('notification.get-all-notifications');
		Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notification.mark-all-as-read');
	});

	Route::post('/notification/{notification}/mark-as-read', [NotificationController::class, 'markNotificationAsRead'])->name('notification.mark-notification-as-read');
});

Route::post('/login', [SessionController::class, 'login'])->name('login');
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

Route::post('/register', RegisterController::class)->name('register');
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
	->middleware('signed')->name('verification.verify');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/forgot-password', [ForgotPasswordController::class, 'checkExpiration'])->name('password.expiration')->middleware('signed');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google/redirect', [SocialiteGoogleController::class, 'handleRedirect'])->name('google-socialite.handle-redirect');
