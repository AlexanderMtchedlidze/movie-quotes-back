<?php

namespace App\Http\Controllers\PasswordReset;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\StoreForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	public function sendResetLink(StoreForgotPasswordRequest $request): void
	{
		Password::sendResetLink($request->validated());
	}

	public function checkExpirationValidity(): JsonResponse
	{
		$expired = session()->get('forgot_password_verification_expiration');
		if (time() > $expired) {
			return response()->json(['error' => 'Forgot password verification link has been expired'], 419);
		}
		return response()->json(['expired' => false]);
	}
}
