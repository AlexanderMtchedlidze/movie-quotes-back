<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'sender_id'   => 'required|exists:users,id',
			'receiver_id' => 'required|exists:users,id',
			'liked'       => 'required_without:commented|boolean',
			'commented'   => 'required_without:liked|boolean',
		];
	}
}
