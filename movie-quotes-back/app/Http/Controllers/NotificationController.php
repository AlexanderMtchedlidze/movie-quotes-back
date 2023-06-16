<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
	public function getAllNotifications()
	{
		$readNotifications = auth()->user()->notifications()->orderByDesc('created_at')->get();

		return [
			'count'         => auth()->user()->unreadNotifications()->count(),
			'notifications' => NotificationResource::collection($readNotifications),
		];
	}

	public function markAllAsRead()
	{
		auth()->user()->unreadNotifications()->update(['read' => true]);

		$readNotifications = auth()->user()->notifications()->orderByDesc('created_at')->get();

		return [
			'count'         => auth()->user()->unreadNotifications()->count(),
			'notifications' => NotificationResource::collection($readNotifications),
		];
	}

	public function markNotificationAsRead(Notification $notification)
	{
		$notification->update(['read' => true]);
		return response()->json([
			'count' => auth()->user()->unreadNotifications()->count(),
		]);
	}
}
