<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CustomEmailVerificationRequest;

class EmailVerificationController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(CustomEmailVerificationRequest $request): void
	{
		$request->fulfill();
	}
}
