<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreForgotPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'email' => ['required', 'email', Rule::exists('users', 'email')],
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
