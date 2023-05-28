<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
	public string $userName;

	public function __construct(string $userName)
	{
		$this->userName = $userName;
	}

	protected function buildMailMessage($url): MailMessage
	{
		return (new MailMessage)
			->view('emails.verify-email', ['url' => $url, 'userName' => $this->userName]);
	}
}
