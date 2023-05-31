<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomVerifyEmail extends Notification
{
	public string $url;

	public string $userName;

	public function __construct(string $url, string $userName)
	{
		$this->url = $url;
		$this->userName = $userName;
	}

	public function via(object $notifiable): array
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		return (new MailMessage)
			->subject('Please verify your email address')
			->view('emails.verify-email', ['url' => $this->url, 'userName' => $this->userName]);
	}
}
