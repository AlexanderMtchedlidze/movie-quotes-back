<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreSessionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
	public function login(StoreSessionRequest $request)
	{
		$attributes = $request->validated();

		$user = User::where('email', $attributes['username'])
			->orWhere('name', $attributes['username'])
			->first();

		if (!$user || !Hash::check($attributes['password'], $user->password)) {
			throw ValidationException::withMessages(['username' => 'The credentials you entered are incorrect']);
		}

		Auth::login($user, $request->filled('remember-me'));
		session()->regenerate();
	}

	public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();
		session()->regenerate();
	}
}
