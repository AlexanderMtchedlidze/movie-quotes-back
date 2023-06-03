<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{
	public function getAllQuotes(): AnonymousResourceCollection
	{
		return QuoteResource::collection(
			Quote::orderByDesc('created_at')
				->with('comments')
				->withCount('comments')
				->with('author')
				->withCount('likes')
				->get()
		);
	}
}
