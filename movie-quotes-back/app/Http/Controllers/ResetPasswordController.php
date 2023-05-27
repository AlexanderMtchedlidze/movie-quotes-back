<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class ResetPasswordController extends Controller
{
	public function redirectWithToken(string $token): RedirectResponse
	{
		return redirect('/your-vue-spa-url')
			->withCookie(Cookie::make('token', $token));
	}
}
