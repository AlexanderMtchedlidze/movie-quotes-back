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
		$commentsCount = $this->whenLoaded('comments', function () {
			return $this->comments->count();
		});

		$likesCount = $this->whenLoaded('likes', function () {
			return $this->likes->count();
		});

		return [
			'id'             => $this->id,
			'quote'          => $this->getTranslations('quote'),
			'thumbnail'      => $this->thumbnail,
			'author'         => new UserResource($this->whenLoaded('author')),
			'comments'       => $this->whenLoaded('comments', function () {
				return CommentResource::collection($this->comments->load('author'));
			}),
			'comments_count'  => $commentsCount,
			'movie'           => $this->whenLoaded('movie'),
			'likes'           => $this->whenLoaded('likes'),
			'likes_count'     => $likesCount,
		];
	}
}