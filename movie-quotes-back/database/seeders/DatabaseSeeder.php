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
		User::factory()->create([
			'email'         => 'test@example.com',
			'password'      => 'example',
			'profile_image' => '/default-profile-image.png',
		]);

		Movie::factory(5)->create();

		Quote::factory(5)->create();

		Comment::factory(5)->create();
	}
}
