<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	public function __invoke(StoreForgotPasswordRequest $request)
	{
		Password::sendResetLink($request->validated());
	}
}
