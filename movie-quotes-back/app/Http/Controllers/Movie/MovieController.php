<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\User;

class MovieController extends Controller
{
	public function getAllMovies()
	{
		return MovieResource::collection(
			Movie::orderByDesc('created_at')
				->with('author')
				->get()
		);
	}

	public function getUserMovies(User $user)
	{
		$movies = $user
			->movies()
			->orderByDesc('created_at')
			->withCount('quotes')
			->get();

		return MovieResource::collection($movies);
	}

	public function addMovie(StoreMovieRequest $request)
	{
		$attributes = $request->validated();

		$movie = Movie::create(['user_id' => auth()->user()->id,
			'movie'                          => [
				'en' => $attributes['movie'],
			], 'director' => [
				'en' => $attributes['director_en'],
				'ka' => $attributes['director_ka'],
			], 'description' => [
				'en' => $attributes['director_en'],
				'ka' => $attributes['description_ka'],
			], 'year' => $attributes['year']]);

		if ($request->hasFile('thumbnail')) {
			$thumbnailPath = $request->file('thumbnail')->store('thumbnail');
			$movie->thumbnail = $thumbnailPath;
		}

		$genreIds = $attributes['genres'];
		$movie->genres()->attach($genreIds);

		return response()->json(['movie' => new MovieResource($movie)]);
	}
}
