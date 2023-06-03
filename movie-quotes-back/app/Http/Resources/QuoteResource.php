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
			'id'             => $this->id,
			'quote'          => $this->quote,
			'thumbnail'      => $this->thumbnail,
			'author'         => new UserResource($this->whenLoaded('author')),
			'comments'       => $this->whenLoaded('comments', function () {
				return CommentResource::collection($this->comments->load('author'));
			}),
			'comments_count'  => $this->whenCounted('comments'),
			'likes_count'     => $this->whenCounted('likes'),
		];
	}
}
