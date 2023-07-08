<?php

namespace App\Http\Controllers\SearchController;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(String $query)
	{
		return QuoteResource::collection(
			Quote::filter(['all' => $query])
				->orderByDesc('created_at')
				->with('author', 'movie', 'comments.author', 'likes')
				->paginate()
		);
	}
}
