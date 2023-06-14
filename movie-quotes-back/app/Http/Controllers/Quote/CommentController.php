<?php

namespace App\Http\Controllers\Quote;

use App\Events\NotificationSent;
use App\Events\UpdateCommentCount;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreCommentRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;

class CommentController extends Controller
{
	public function addComment(StoreCommentRequest $request, Quote $quote)
	{
		$comment = Comment::create([
			'user_id'  => auth()->user()->id,
			'quote_id' => $quote->id,
			'comment'  => $request->validated()['comment'],
		]);

		$commentsCount = $quote->comments()->count();

		event(new UpdateCommentCount($commentsCount, $quote->id));

		$notification = Notification::create([
			'receiver_id' => $quote->user_id,
			'sender_id'   => auth()->user()->id,
			'commented'   => true,
		]);

		$notification->load('receiver', 'sender');

		event(new NotificationSent(new NotificationResource($notification)));

		return response()->json(['comment_id' => $comment->id, 'comments_count' => $commentsCount]);
	}
}
