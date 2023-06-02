<?php

namespace App\Http\Resources;

use App\Models\User;
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
		return array_merge(
			parent::toArray($request),
			['author'   => new UserResource(User::findOrFail($this->user_id))],
			['comments' => CommentResource::collection($this->comments)]
		);
	}
}
