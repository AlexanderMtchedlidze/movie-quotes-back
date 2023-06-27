<?php

namespace App\Http\Controllers\PasswordReset;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\StoreResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
	public function resetPassword(StoreResetPasswordRequest $request): void
	{
		Password::reset(
			$request->validated(),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => $password,
				]);
				$user->save();
			}
		);
	}
}
