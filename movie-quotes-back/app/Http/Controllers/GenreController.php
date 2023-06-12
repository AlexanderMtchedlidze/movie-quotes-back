<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
	public function getAllGenres()
	{
		return GenreResource::collection(Genre::all());
	}
}
