<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$userId = auth()->user()->id;

		return [
			'profile_image' => 'nullable',
			'username'      => ['nullable', Rule::unique('users', 'name')->ignore($userId)],
			'email'         => [
				'nullable',
				'email',
				Rule::unique('users')->ignore($userId),
			],
			'password'      => 'nullable|min:8|max:15|regex:/^[a-z]+$/|confirmed',
		];
	}
}
