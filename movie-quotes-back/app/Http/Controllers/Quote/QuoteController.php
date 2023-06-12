<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
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
				->paginate()
		);
	}

	public function addQuote(StoreQuoteRequest $request)
	{
		$quote = Quote::create([
			'user_id'  => $request->user()->id,
			'movie_id' => $request->movie_id,
			'quote'    => [
				'en' => $request->quote_en,
				'ka' => $request->quote_ka,
			],
		]);

		if ($request->hasFile('thumbnail')) {
			$thumbnailPath = $request->file('thumbnail')->store('thumbnails');
			$quote->thumbnail = $thumbnailPath;
		}

		$quote->save();

		$quote->load('author', 'movie', 'comments', 'likes');

		return response()->json(['quote' => new QuoteResource($quote)]);
	}
}
