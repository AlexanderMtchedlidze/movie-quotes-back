<?php

namespace Database\Factories;

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
		return [
			'thumbnail' => fake()->image('public/storage', 800),
			'quote'     => fake()->paragraph,
			'likes'     => fake()->numberBetween(10, 35),
		];
	}
}
