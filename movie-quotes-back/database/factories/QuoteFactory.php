<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$movie = Movie::inRandomOrder()->first();
		$user = User::inRandomOrder()->first();

		return [
			'thumbnail' => fake()->image('public/storage', 800),
			'quote'     => fake()->paragraph,
			'movie_id'  => $movie->id,
			'user_id'   => $user->id,
		];
	}
}
