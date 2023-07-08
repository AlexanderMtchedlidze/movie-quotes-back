<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegisterRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name'     => ['required', 'min:3', 'max:15', 'regex:/^[a-z0-9]+$/'],
			'email'    => ['required', 'email', Rule::unique('users', 'email'), 'email'],
			'password' => ['required', 'min:8', 'max:15', 'regex:/^[a-z0-9]+$/', 'confirmed'],
		];
	}

	public function messages()
	{
		return [
			'email.unique' => [
				'en' => 'Email must be unique',
				'ka' => 'ელ-ფოსტა უნდა იყოს განსაკუთრებული',
			],
		];
	}
}
