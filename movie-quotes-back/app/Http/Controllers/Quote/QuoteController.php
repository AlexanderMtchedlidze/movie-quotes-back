<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Resources\MovieResource;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use App\Policies\QuotePolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{
	public function getAllQuotes(): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::orderByDesc('created_at')
				->with('author', 'movie', 'comments', 'likes')
				->paginate()
		);
	}

	public function getQuote(Quote $quote): QuoteResource
	{
		$quote->load('author', 'movie', 'comments', 'likes');
		return new QuoteResource($quote);
	}

	public function addQuote(StoreQuoteRequest $request): JsonResponse
	{
		$quote = Quote::create([
			'user_id'   => $request->user()->id,
			'movie_id'  => $request->movie_id,
			'thumbnail' => $request->file('thumbnail')->store('thumbnails'),
			'quote'     => [
				'en' => $request->quote_en,
				'ka' => $request->quote_ka,
			],
		]);

		$quote->load('author', 'movie', 'comments', 'likes');
		$quote->movie->load('genres', 'quotes')->loadCount('quotes');

		return response()->json([
			'quote' => new QuoteResource($quote),
			'movie' => new MovieResource($quote->movie),
		]);
	}

	public function deleteQuote(Quote $quote): JsonResponse
	{
		$movie = $quote->movie;
		$quotePolicy = new QuotePolicy($quote, $movie);

		if ($quotePolicy->delete(auth()->user())) {
			$quote->delete();
		}

		return response()->json([
			'count' => $movie->quotes()->count(),
		]);
	}
}
