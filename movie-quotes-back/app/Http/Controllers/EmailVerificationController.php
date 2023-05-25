<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(CustomEmailVerificationRequest $request): JsonResponse
	{
		$request->fulfill();

		return response()->json([
			'message' => 'Email verification fulfilled successfully',
		]);
	}
}
