<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$user = User::inRandomOrder()->first();

		return [
			'movie'     => [
				'en' => fake()->words(3, true),
				'ka' => fake('ka_GE')->realText(30),
			],
			'thumbnail' => fake()->image('public/storage', 800),
			'user_id'   => $user->id,
		];
	}
}
