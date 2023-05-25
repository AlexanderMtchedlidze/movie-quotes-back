<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(StoreRegisterRequest $request)
	{
		$attributes = $request->validated();

		$user = User::create($attributes);

		return response()->json([
			'user'  => $user,
			'token' => $user->createToken('laravel_api_token'),
		]);
	}
}
