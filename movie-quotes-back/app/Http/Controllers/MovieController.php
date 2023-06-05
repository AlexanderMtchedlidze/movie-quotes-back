<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
	public function getAllMovies()
	{
		return MovieResource::collection(
			Movie::orderByDesc('created_at')
				->with('author')
				->get()
		);
	}
}
