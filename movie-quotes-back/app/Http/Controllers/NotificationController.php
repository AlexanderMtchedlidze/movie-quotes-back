<?php

namespace App\Http\Controllers;

use App\Events\NotificationSent;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;

class NotificationController extends Controller
{
	public function sendNotification(StoreNotificationRequest $request)
	{
		$notification = Notification::create($request->validated());

		event(new NotificationSent($notification));
	}
}
