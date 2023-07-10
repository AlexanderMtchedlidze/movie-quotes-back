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
			'profile_image' => ['nullable', 'image'],
			'username'      => ['nullable', 'min:3', 'max:15', 'regex:/^[a-z0-9]+$/'],
			'email'         => ['nullable', 'email', Rule::unique('users')->ignore($userId)],
			'password'      => ['nullable', 'min:8', 'max:15', 'regex:/^[a-z0-9]+$/', 'confirmed'],
		];
	}

	public function messages()
	{
		return [
			'profile_image.image' => [
				'en' => 'Image must be an image',
				'ka' => 'სურათი უნდა იყოს სურათი',
			],
			'email.unique' => [
				'en' => 'Email must be unique',
				'ka' => 'ელ-ფოსტა უნდა იყოს განსაკუთრებული',
			],
		];
	}
}
