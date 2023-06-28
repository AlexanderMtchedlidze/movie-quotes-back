<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreSessionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
	public function login(StoreSessionRequest $request): void
	{
		$attributes = $request->validated();

		$user = User::where('email', $attributes['username'])
			->orWhere('name', $attributes['username'])
			->first();

		if (!$user || !Hash::check($attributes['password'], $user->password)) {
			$errorMessages = [
				'username' => [
					'en' => 'The credentials you entered are incorrect',
					'ka' => 'შეყვანილი მონაცემები არასწორია',
				],
			];

			throw ValidationException::withMessages($errorMessages);
		}

		auth()->login($user, $request->filled('remember-me'));
		session()->regenerate();
	}

	public function logout(): void
	{
		auth()->logout();

		session()->regenerate();
	}
}
