<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GenreMoviesFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$movie = Movie::inRandomOrder()->first();
		$genre = Genre::inRandomOrder()->first();

		return [
			'movie_id' => $movie->id,
			'genre_id' => $genre->id,
		];
	}
}
