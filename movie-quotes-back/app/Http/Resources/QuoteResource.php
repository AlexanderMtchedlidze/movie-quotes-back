<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'              => $this->id,
			'quote'           => $this->getTranslations('quote'),
			'thumbnail'       => $this->thumbnail,
			'author'          => new UserResource($this->whenLoaded('author')),
			'comments'        => $this->whenLoaded('comments'),
			'comments_count'  => $this->whenLoaded('comments', $this->comments->count()),
			'movie'           => $this->whenLoaded('movie'),
			'likes'           => $this->whenLoaded('likes'),
			'likes_count'     => $this->whenLoaded('likes', $this->likes->count()),
		];
	}
}
