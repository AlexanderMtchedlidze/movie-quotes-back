<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(public string $url, public string $userName, public string $email)
	{
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
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
			->subject('Reset password')
			->view('emails.reset-password', ['url' => $this->url, 'userName' => $this->userName, 'email' => $this->email]);
	}
}
