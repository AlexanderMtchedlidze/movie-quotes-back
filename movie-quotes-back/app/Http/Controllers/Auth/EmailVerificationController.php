<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request): JsonResponse
	{
		$email = $request->query('email');

		$user = User::find($request->route('id'));

		$expiration = session()->get('registration_verification_expiration');

		if (time() > $expiration) {
			return response()->json(['error' => 'Registration verification link has been expired'], 419);
		}

		if ($email) {
			$user->email = $email;
			$user->save();
		}

		if ($user && !$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}

		return response()->json(['message' => 'Email verified successfully']);
	}
}
