<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResetPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'token'    => ['required'],
			'email'    => ['required', 'email', Rule::exists('users', 'email')],
			'password' => ['required', 'min:8', 'max:15', 'confirmed'],
		];
	}

	public function messages()
	{
		return [
			'email.exists' => [
				'en' => 'Email must exist',
				'ka' => 'ელფოსტა უნდა არსებობდეს',
			],
		];
	}
}
