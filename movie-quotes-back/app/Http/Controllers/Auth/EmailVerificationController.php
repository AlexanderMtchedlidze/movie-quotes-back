<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		$email = $request->query('email');

		$user = User::find($request->route('id'));

		if ($email) {
			$user->email = $email;
			$user->save();
		}

		if ($user && !$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}
	}
}
