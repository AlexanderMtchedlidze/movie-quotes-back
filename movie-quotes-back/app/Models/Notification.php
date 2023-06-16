<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
	use HasFactory;

	protected $with = [
		'sender',
		'receiver',
	];

	public function quote(): BelongsTo
	{
		return $this->belongsTo(Quote::class);
	}

	public function sender(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function receiver(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
