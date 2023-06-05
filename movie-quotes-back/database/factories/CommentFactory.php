<?php

namespace Database\Factories;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$user = User::inRandomOrder()->first();
		$quote = Quote::inRandomOrder()->first();

		return [
			'comment'  => fake()->paragraph,
			'user_id'  => $user->id,
			'quote_id' => $quote->id,
		];
	}
}
