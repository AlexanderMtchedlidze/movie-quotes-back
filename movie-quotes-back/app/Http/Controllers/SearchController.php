<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function filterQuotes(String $query): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::filter(['quote' => $query])
				->orderByDesc('created_at')
				->with('author', 'movie', 'comments', 'likes')
				->paginate()
		);
	}

	public function filterMovies(String $query): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::filter(['movie' => $query])
				->orderByDesc('created_at')
				->with('author', 'movie', 'comments', 'likes')
				->paginate()
		);
	}
}
