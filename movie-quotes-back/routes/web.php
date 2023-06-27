<?php

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

Route::get('/auth/google/callback', [SocialiteGoogleController::class, 'handleCallback']);

Route::get('/swagger', fn () => App::isProduction() ? response(status:403) : view('swagger'))->name('swagger');
