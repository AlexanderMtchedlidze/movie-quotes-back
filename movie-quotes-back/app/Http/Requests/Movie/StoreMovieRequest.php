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
			'movie_ka'             => ['required', Rule::unique('movies', 'movie->ka')],
			'movie_en'             => ['required', Rule::unique('movies', 'movie->en')],
			'thumbnail'            => ['required', 'image'],
			'description_en'       => ['required'],
			'description_ka'       => ['required'],
			'year'                 => ['required', 'integer'],
			'director_en'          => ['required'],
			'director_ka'          => ['required'],
			'genre_ids'            => ['required', 'array', 'min:1', Rule::exists('genres', 'id')],
		];
	}

	public function messages(): array
	{
		return [
			'movie_ka.unique' => [
				'en' => 'English movie must be unique',
				'ka' => 'ინგლისურის ფილმი უნდა იყოს განსაკუთრებული',
			],
			'movie_en.unique' => [
				'en' => 'Georgian movie must be unique',
				'ka' => 'ქართული ფილმი უნდა იყოს განსაკუთრებული',
			],
			'thumbnail.image' => [
				'en' => 'Image must be an image',
				'ka' => 'ფოტო უნდა იყოს',
			],
		];
	}
}
