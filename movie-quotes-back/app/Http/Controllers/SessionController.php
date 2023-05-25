<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Models\User;
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

		return response()->json([
			'user'  => $user,
			'token' => $user->createToken('laravel_api_token')->plainTextToken,
		]);
	}

	public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();
	}
}
