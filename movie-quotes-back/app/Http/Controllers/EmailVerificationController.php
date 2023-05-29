<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class EmailVerificationController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(CustomEmailVerificationRequest $request): RedirectResponse
	{
		$request->fulfill();

		$url = config('app.vite_app_url');

		$queryParams = [
			'email_verification_success' => true,
		];

		$urlWithParams = $url . '?' . http_build_query($queryParams);

		return redirect($urlWithParams);
	}
}
