<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;

class RegisterController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(StoreRegisterRequest $request): void
	{
		$attributes = $request->validated();

		$user = User::create($attributes);

		$url = $user->generateVerificationUrl();

		$user->notify(new CustomVerifyEmail($url, $user->name));

		auth()->login($user);
	}
}
