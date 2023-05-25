<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'username' => 'required|min:3|max:15|regex:/^[a-z]+$/',
			'email'    => 'required|email',
			'password' => 'required|min:8|max:15|regex:/^[a-z]+$/|confirmed',
		];
	}
}
