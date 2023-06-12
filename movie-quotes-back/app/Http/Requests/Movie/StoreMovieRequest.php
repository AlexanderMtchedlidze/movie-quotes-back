<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'movie_ka'          => ['required', Rule::unique('movies', 'movie->ka')],
			'movie_en'          => ['required', Rule::unique('movies', 'movie->en')],
			'thumbnail'         => 'required|image',
			'description_en'    => 'required',
			'description_ka'    => 'required',
			'director_en'       => 'required',
			'director_ka'       => 'required',
		];
	}
}
