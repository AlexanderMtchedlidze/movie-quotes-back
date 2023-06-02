<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user = User::factory()->create([
			'email'         => 'test@example.com',
			'password'      => 'example',
			'profile_image' => '/default-profile-image.png',
		]);

		$movie = Movie::factory()->create([
			'user_id' => $user->id,
		]);

		Quote::factory(5)->create([
			'user_id'   => $user->id,
			'movie_id'  => $movie->id,
		]);

		$quote = Quote::factory()->create([
			'user_id'   => $user->id,
			'movie_id'  => $movie->id,
		]);

		Comment::factory(5)->create([
			'quote_id' => $quote->id,
			'user_id'  => $user->id,
		]);
	}
}
