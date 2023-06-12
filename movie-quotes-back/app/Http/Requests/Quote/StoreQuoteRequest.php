<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'quote_en'    => [
				'required',
				Rule::unique('quotes', 'quote->en'),
			],
			'quote_ka'    => [
				'required',
				Rule::unique('quotes', 'quote->en')],
			'thumbnail'   => 'required|image',
			'movie_id'    => 'required|exists:movies,id',
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
				'ka' => 'ფოტო უნდა იყოს',
			],
		];
	}
}
