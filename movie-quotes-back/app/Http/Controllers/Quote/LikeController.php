<?php

namespace App\Http\Controllers\Quote;

use App\Events\NotificationSent;
use App\Events\UpdateLikeCount;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use App\Policies\NotificationPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function likeQuote(Request $request, Quote $quote): JsonResponse
	{
		$like = Like::where('quote_id', $quote->id)
					->where('user_id', $request->user()->id);

		$notificationPolicy = new NotificationPolicy();

		if ($quote->exists()) {
			if ($like->exists()) {
				$like->delete();

				$likesCount = $quote->likes()->count();

				event(new UpdateLikeCount($likesCount, $quote->id));

				return response()->json(['likes_count' => $likesCount]);
			} else {
				$like = new Like();
				$like->user_id = $request->user()->id;
				$like->quote_id = $quote->id;
				$like->save();
			}

			$likesCount = $quote->likes()->count();

			event(new UpdateLikeCount($likesCount, $quote->id));

			if ($notificationPolicy->create(auth()->user(), $quote)) {
				$notification = Notification::create([
					'quote_id'    => $quote->id,
					'receiver_id' => $quote->user_id,
					'sender_id'   => auth()->user()->id,
					'liked'       => true,
				]);
				$notification->load('receiver', 'sender');

				event(new NotificationSent(
					new NotificationResource($notification),
					$quote->author->unreadNotifications()->count()
				));
			}
			return response()->json(['likes_count' => $likesCount, 'user_in_likes' => true]);
		}

		return response()->json(['error' => 'Quote not found'], 404);
	}
}
