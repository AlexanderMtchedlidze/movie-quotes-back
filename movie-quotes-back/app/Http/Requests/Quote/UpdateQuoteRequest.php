<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'movie_id'  => 'required|exists:movies,id',
			'quote_en'  => 'unique:quotes,quote->en',
			'quote_ka'  => 'unique:quotes,quote->ka',
			'thumbnail' => 'image',
		];
	}

	public function messages(): array
	{
		return [
			'quote_en.unique' => [
				'en' => 'English quote must be unique',
				'ka' => 'ინგლისურის ციტატა უნდა იყოს განსაკუთრებული',
			],
			'quote_ka.unique' => [
				'en' => 'Georgian quote must be unique',
				'ka' => 'ქართული ციტატა უნდა იყოს განსაკუთრებული',
			],
			'thumbnail.image' => [
				'en' => 'Image must be an image',
				'ka' => 'ფოტო უნდა იყოს ფოტო',
			],
		];
	}
}
