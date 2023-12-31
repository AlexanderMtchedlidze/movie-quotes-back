<?php

namespace App\Http\Controllers\Quote;

use App\Events\NotificationSent;
use App\Events\UpdateQuoteComments;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreCommentRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;
use App\Policies\NotificationPolicy;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
	public function addComment(StoreCommentRequest $request, Quote $quote): JsonResponse
	{
		$notificationPolicy = new NotificationPolicy();

		$comment = Comment::create([
			'user_id'  => auth()->id(),
			'quote_id' => $quote->id,
			'comment'  => $request->validated()['comment'],
		]);

		$comment->load('author');

		$commentsCount = $quote->comments()->count();

		event(new UpdateQuoteComments($commentsCount, $comment, $quote->id));

		if ($notificationPolicy->create(auth()->user(), $quote)) {
			$notification = Notification::create([
				'quote_id'    => $quote->id,
				'receiver_id' => $quote->user_id,
				'sender_id'   => auth()->id(),
				'commented'   => true,
			]);
			$notification->load('receiver', 'sender');

			event(new NotificationSent(
				new NotificationResource($notification),
				$quote->author->unreadNotifications()->count()
			));
		}

		return response()->json(['comment_id' => $comment->id, 'comments_count' => $commentsCount]);
	}
}
