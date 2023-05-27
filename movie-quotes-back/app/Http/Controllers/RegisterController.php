<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;

class RegisterController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(StoreRegisterRequest $request)
	{
		$attributes = $request->validated();

		$user = User::create($attributes);

		$user->notify(new CustomVerifyEmail($user->name));
	}
}
