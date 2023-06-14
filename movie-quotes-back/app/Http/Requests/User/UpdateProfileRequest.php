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
			'profile_image' => 'image',
			'username'      => [
				Rule::unique('users', 'name')->ignore($userId),
			],
			'email'         => [
				'email',
				Rule::unique('users')->ignore($userId),
			],
			'password'      => 'min:8|max:15|regex:/^[a-z]+$/|confirmed',
		];
	}

	public function messages()
	{
		return [
			'profile_image' => [
				'en' => 'Image must be an image :)',
				'ka' => 'სურათი უნდა იყოს სურათი',
			],
			'username.unique' => [
				'en' => 'Name must be unique',
				'ka' => 'სახელი უნდა იყოს განსაკუთრებული',
			],
			'email.unique' => [
				'en' => 'Email must be unique',
				'ka' => 'ელფოსტა უნდა იყოს განსაკუთრებული',
			],
		];
	}
}
