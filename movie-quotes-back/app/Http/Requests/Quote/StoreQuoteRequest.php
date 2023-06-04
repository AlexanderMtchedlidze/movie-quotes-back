<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;

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
			'quote_en'  => 'required',
			'quote_ka'  => 'required',
			'thumbnail' => 'required|image',
			'movie_id'  => 'required|exists:movies,id',
		];
	}
}
