<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['movie'];

	public function author(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function genres(): BelongsToMany
	{
		return $this->belongsToMany(Genre::class);
	}
}
