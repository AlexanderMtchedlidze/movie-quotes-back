<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'         => $this->id,
			'quote_id'   => $this->quote->id,
			'read'       => $this->read,
			'sender'     => $this->whenLoaded('sender'),
			'receiver'   => $this->whenLoaded('receiver'),
			'liked'      => $this->liked,
			'commented'  => $this->commented,
			'created_at' => $this->created_at,
		];
	}
}
