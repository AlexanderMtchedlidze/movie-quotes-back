<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Quote;

class CommentController extends Controller
{
	public function addComment(StoreCommentRequest $request, int $id)
	{
		$quote = Quote::find($id);

		if ($quote) {
			$comment = Comment::create([
				'user_id'  => $request->user()->id,
				'quote_id' => $quote->id,
				'comment'  => $request->validated()['comment'],
			]);

			$commentsCount = $quote->comments()->count();

			return response()->json(['comment_id' => $comment->id, 'comments_count' => $commentsCount]);
		}
		return response()->json(['Quote doesn\'t exist'], 404);
	}
}
