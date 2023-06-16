<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\GenreMovies;
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
		User::factory()->create([
			'email'             => 'test@example.com',
			'profile_image'     => '/default-profile-image.png',
			'email_verified_at' => now(),
			'password'          => 'password',
		]);

		Movie::factory(5)->create();

		Genre::factory(10)->create();

		GenreMovies::factory(5)->create();

		Quote::factory(30)->create();

		Comment::factory(5)->create();
	}
}
