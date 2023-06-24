<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function getUser(Request $request)
	{
		return $request->user();
	}

	public function updateUser(UpdateProfileRequest $request)
	{
		$attributes = $request->validated();
		$user = $request->user();

		if ($request->hasFile('profile_image')) {
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
