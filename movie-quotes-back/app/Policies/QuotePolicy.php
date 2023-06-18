<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\Quote;
use App\Models\User;

class QuotePolicy
{
	/**
	 * Create a new policy instance.
	 */
	public function __construct(public Quote $quote, public Movie $movie)
	{
	}

	public function update(User $user): bool
	{
		return $user->id === $this->quote->author->id
			|| $user->id === $this->movie->author->id;
	}

	public function delete(User $user): bool
	{
		return $user->id === $this->quote->author->id
			|| $user->id === $this->movie->author->id;
	}
}
