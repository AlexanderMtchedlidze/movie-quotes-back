<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
			'name'     => 'required|min:3|max:15|regex:/^[a-z]+$/|unique:users,name',
			'email'    => 'required|email|unique:users,email',
			'password' => 'required|min:8|max:15|regex:/^[a-z]+$/|confirmed',
		];
	}
}
