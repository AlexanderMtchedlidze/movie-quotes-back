<?php

namespace App\Http\Controllers\NotificationController;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
	public function getAllNotifications(): JsonResponse
	{
		$readNotifications = auth()->user()->notifications()->orderByDesc('created_at')->get();

		return response()->json([
			'count'         => auth()->user()->unreadNotifications()->count(),
			'notifications' => NotificationResource::collection($readNotifications),
		]);
	}

	public function markAllAsRead(): JsonResponse
	{
		auth()->user()->unreadNotifications()->update(['read' => true]);

		$readNotifications = auth()->user()->notifications()->orderByDesc('created_at')->get();

		return response()->json([
			'count'         => auth()->user()->unreadNotifications()->count(),
			'notifications' => NotificationResource::collection($readNotifications),
		]);
	}

	public function markNotificationAsRead(Notification $notification): JsonResponse
	{
		$notification->update(['read' => true]);
		return response()->json([
			'count' => auth()->user()->unreadNotifications()->count(),
		]);
	}
}
