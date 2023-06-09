<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function likeQuote(Request $request, Quote $quote): JsonResponse
	{
		$like = Like::where('quote_id', $quote->id)
					->where('user_id', $request->user()->id);

		if ($quote->exists()) {
			if ($like->exists()) {
				$like->delete();

				$likesCount = $quote->likes()->count();
				return response()->json(['likes_count' => $likesCount]);
			} else {
				$like = new Like();
				$like->user_id = $request->user()->id;
				$like->quote_id = $quote->id;
				$like->save();
			}

			$likesCount = $quote->likes()->count();

			return response()->json(['likes_count' => $likesCount, 'user_in_likes' => true]);
		}

		return response()->json(['error' => 'Quote not found'], 404);
	}
}
