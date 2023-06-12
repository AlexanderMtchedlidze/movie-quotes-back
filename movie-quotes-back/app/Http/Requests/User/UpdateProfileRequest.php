<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'profile_image' => 'nullable',
			'username'      => 'nullable',
			'email'         => 'nullable|email',
			'password'      => 'nullable|min:8|max:15|regex:/^[a-z]+$/|confirmed',
		];
	}
}
