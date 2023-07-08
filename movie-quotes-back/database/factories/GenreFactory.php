<?php

namespace Database\Factories;

use App\Models\Genre;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$genres = [
			['ka'    => 'სათავგადასავლო', 'en' => 'Adventure'],
			['ka'    => 'თრილერი', 'en' => 'Thriller'],
			['ka'    => 'კომედია', 'en' => 'Comedy'],
		];

		$genre = Arr::random($genres);

		$existingGenre = Genre::where(function ($query) use ($genre) {
			$query->where('genre->en', 'like', '%' . $genre['en'] . '%')
				->orWhere('genre->ka', 'like', '%' . $genre['ka'] . '%');
		})->first();

		if ($existingGenre) {
			dd($existingGenre);
		}

		return [
			'genre' => $genre,
		];
	}
}
