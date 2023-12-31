<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GenreController extends Controller
{
	public function getAllGenres(): AnonymousResourceCollection
	{
		return GenreResource::collection(Genre::all());
	}
}
