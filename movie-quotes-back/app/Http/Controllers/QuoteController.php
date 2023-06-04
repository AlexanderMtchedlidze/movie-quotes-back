<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{
	public function getAllQuotes(): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::orderByDesc('created_at')
				->with('author', 'movie', 'comments', 'likes')
				->get()
		);
	}

	public function addQuote(StoreQuoteRequest $request)
	{
		$quote = new Quote();
		$quote->user_id = $request->user()->id;
		$quote->movie_id = $request->movie_id;
		$quote->quote = [
			'en' => $request->quote_en,
			'ka' => $request->quote_ka,
		];

		if ($request->hasFile('thumbnail')) {
			$thumbnailPath = $request->file('thumbnail')->store('thumbnails');
			$quote->thumbnail = $thumbnailPath;
		}

		$quote->save();

		$quote->load('author', 'movie', 'comments', 'likes');

		return response()->json(['quote' => new QuoteResource($quote)]);
	}
}
