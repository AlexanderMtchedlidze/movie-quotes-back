<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Http\Resources\QuoteResource;
use App\Models\Movie;
use App\Models\Quote;
use App\Models\User;
use App\Policies\MoviePolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
	public function getAllMovies(): AnonymousResourceCollection
	{
		return MovieResource::collection(
			Movie::orderByDesc('created_at')
				->with('author')
				->get()
		);
	}

	public function filterQuotes(String $query): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::filter(['movie' => $query])
				->orderByDesc('created_at')
				->with('author', 'movie', 'comments.author', 'likes')
				->paginate()
		);
	}

	public function getUserMovies(User $user): JsonResponse
	{
		$movies = $user
			->movies()
			->orderByDesc('created_at')
			->withCount('quotes')
			->get();

		return response()->json([
			'count'  => $movies->count(),
			'movies' => MovieResource::collection($movies),
		]);
	}

	public function addMovie(StoreMovieRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		$movie = Movie::create(['user_id' => auth()->id(),
			'movie'                          => [
				'en' => $attributes['movie_en'],
				'ka' => $attributes['movie_ka'],
			], 'director' => [
				'en' => $attributes['director_en'],
				'ka' => $attributes['director_ka'],
			], 'description' => [
				'en' => $attributes['director_en'],
				'ka' => $attributes['description_ka'],
			], 'year' => $attributes['year'],
			'thumbnail' => $request->file('thumbnail')->store('thumbnails'),
			'budget'    => $attributes['budget'],
		]);

		$genreIds = $attributes['genre_ids'];
		$movie->genres()->attach($genreIds);

		$movie->loadCount('quotes');

		return response()->json([
			'movie' => new MovieResource($movie),
			'count' => auth()->user()->movies()->count(),
		]);
	}

	public function getMovie(Movie $movie): JsonResponse
	{
		$movie->load('genres', 'quotes')->loadCount('quotes');
		$movie->quotes->loadCount(['likes', 'comments']);

		return response()->json([
			'movie' => new MovieResource($movie),
		]);
	}

	public function deleteMovie(Movie $movie): void
	{
		$moviePolicy = new MoviePolicy($movie);
		if ($moviePolicy->destroy()) {
			$movie->delete();
		}
	}

	public function editMovie(Movie $movie, UpdateMovieRequest $request): JsonResponse
	{
		$moviePolicy = new MoviePolicy($movie);
		if ($moviePolicy->update()) {
			$attributes = $request->validated();

			$movieData = [
				'movie' => [
					'en' => $attributes['movie_en'],
					'ka' => $attributes['movie_ka'],
				],
				'director' => [
					'en' => $attributes['director_en'],
					'ka' => $attributes['director_ka'],
				],
				'description' => [
					'en' => $attributes['description_en'],
					'ka' => $attributes['description_ka'],
				], 'year' => $attributes['year'],
				'budget' => $attributes['budget'],
			];

			if ($request->hasFile('thumbnail')) {
				Storage::disk('thumbnails')->delete($movie->thumbnail);
				$movieData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
			}

			$movie->update($movieData);

			if (isset($attributes['genre_ids'])) {
				$movie->genres()->sync($attributes['genre_ids']);
			}

			$movie->load('genres', 'quotes')->loadCount('quotes');
		}
		return response()->json([
			'movie' => new MovieResource($movie),
			'count' => auth()->user()->movies()->count(),
		]);
	}
}
