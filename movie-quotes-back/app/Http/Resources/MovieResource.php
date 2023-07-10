<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'           => $this->id,
			'author'       => $this->whenLoaded('author'),
			'quotes'       => $this->whenLoaded('quotes'),
			'quotes_count' => $this->whenCounted('quotes'),
			'movie'        => $this->getTranslations('movie'),
			'thumbnail'    => $this->thumbnail,
			'director'     => $this->getTranslations('director'),
			'genres'       => $this->whenLoaded('genres'),
			'description'  => $this->getTranslations('description'),
			'year'         => $this->year,
			'budget'       => $this->budget,
		];
	}
}
