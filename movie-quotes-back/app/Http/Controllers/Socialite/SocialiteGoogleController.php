<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteGoogleController extends Controller
{
	public function handleRedirect(): RedirectResponse
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleCallback(): RedirectResponse
	{
		$googleUser = Socialite::driver('google')->user();

		$user = User::updateOrCreate([
			'email' => $googleUser->email,
		], [
			'name'                 => $googleUser->name,
			'email'                => $googleUser->email,
			'google_token'         => $googleUser->token,
			'email_verified_at'    => now(),
			'profile_image'        => 'default-profile-image.png',
		]);

		Auth::login($user);

		$url = config('app.vite_app_url') . config('app.vite_news_feed_url');

		return redirect($url);
	}
}
