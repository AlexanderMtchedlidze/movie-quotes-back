<?php

namespace App\Policies;

use App\Models\Movie;

class MoviePolicy
{
	public function __construct(public Movie $movie)
	{
	}

	public function destroy(): bool
	{
		return auth()->user()->id === $this->movie->author->id;
	}

	public function update(): bool
	{
		return auth()->user()->id === $this->movie->author->id;
	}
}
