<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function getEmailVerification(string $email): void
	{
		$user = User::where('email', $email)->first();

		$user->notify(new CustomVerifyEmail($user->generateVerificationUrl(), $user->name));
	}

	public function getUser(Request $request): User
	{
		return $request->user();
	}

	public function updateUser(UpdateProfileRequest $request): JsonResponse
	{
		$attributes = $request->validated();
		$user = auth()->user();

		if ($request->hasFile('profile_image')) {
			Storage::delete($user->profile_image);
			$profileImagePath = $request->file('profile_image')->store();
			$user->profile_image = $profileImagePath;
		}

		if (isset($attributes['email'])) {
			$user->notify(new CustomVerifyEmail($user->generateVerificationUrl($attributes['email']), $user->name));
		}

		if (isset($attributes['username'])) {
			$user->name = $attributes['username'];
		}

		if (isset($attributes['password'])) {
			$user->password = $attributes['password'];
		}

		$user->save();

		return response()->json(['user' => $user]);
	}
}
