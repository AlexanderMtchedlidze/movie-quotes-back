<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	public function __invoke(StoreForgotPasswordRequest $request)
	{
		$email = $request->validated()['email'];

		$status = Password::sendResetLink($email);

		return $status === Password::RESET_LINK_SENT
			? back()->with(['status' => __($status)])
			: back()->withErrors(['email' => __($status)]);
	}
}
