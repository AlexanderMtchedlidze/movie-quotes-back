<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class CustomEmailVerificationRequest extends EmailVerificationRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		$user = User::find($this->route('id'));
		if (!hash_equals((string) $user->getKey(), (string) $this->route('id'))) {
			return false;
		}

		if (!hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
			return false;
		}

		return true;
	}

	public function fulfill()
	{
		$user = User::find($this->route('id'));

		if ($user && !$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}
	}
}
