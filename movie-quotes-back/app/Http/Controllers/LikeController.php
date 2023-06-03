<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function likeQuote(Request $request, int $id): JsonResponse
	{
		$quote = Quote::findOrFail($id);

		$like = Like::where('quote_id', $id)
					->where('user_id', $request->user()->id);

		if ($quote->exists()) {
			if ($like->exists()) {
				$like->delete();
			} else {
				$like = new Like();
				$like->user_id = $request->user()->id;
				$like->quote_id = $quote->id;
				$like->save();
			}

			$likesCount = $quote->likes()->count();

			return response()->json(['likes_count' => $likesCount]);
		}

		return response()->json(['error' => 'Quote not found'], 404);
	}
}
