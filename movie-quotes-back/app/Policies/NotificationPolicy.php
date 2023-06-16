<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;

class NotificationPolicy
{
	/**
	 * Determine if the given post can be updated by the user.
	 */
	public function create(User $user, Quote $quote): bool
	{
		return $user->id !== $quote->user_id;
	}
}
