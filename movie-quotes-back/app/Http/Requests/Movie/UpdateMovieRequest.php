<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$movieId = $this->route('movie');

		return [
			'movie_en'             => ['sometimes', Rule::unique('movies', 'movie->en')->ignore($movieId)],
			'movie_ka'             => ['sometimes', Rule::unique('movies', 'movie->en')->ignore($movieId)],
			'thumbnail'            => ['sometimes', 'image'],
			'year'                 => ['sometimes', 'integer'],
			'director_en'          => ['sometimes'],
			'director_ka'          => ['sometimes'],
			'description_en'       => ['sometimes'],
			'description_ka'       => ['sometimes'],
			'budget'               => ['sometimes', 'integer'],
			'genre_ids'            => ['sometimes', 'array', 'min:1', Rule::exists('genres', 'id')],
		];
	}
}
