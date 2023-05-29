<?php

namespace App\Http\Controllers\PasswordReset;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\StoreForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	public function __invoke(StoreForgotPasswordRequest $request)
	{
		Password::sendResetLink($request->validated());
	}
}
