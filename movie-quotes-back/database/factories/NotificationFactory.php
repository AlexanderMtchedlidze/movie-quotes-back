<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'sender_id'   => User::factory()->create()->id,
			'receiver_id' => User::factory()->create()->id,
			'commented'   => fake()->boolean,
			'liked'       => fake()->boolean,
		];
	}
}
