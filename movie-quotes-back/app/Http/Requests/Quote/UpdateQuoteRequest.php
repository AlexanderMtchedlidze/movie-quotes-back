<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$quoteId = $this->route('quote');

		return [
			'movie_id'  => 'required|exists:movies,id',
			'quote_en'  => Rule::unique('quotes', 'quote->en')->ignore($quoteId),
			'quote_ka'  => Rule::unique('quotes', 'quote->ka')->ignore($quoteId),
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
