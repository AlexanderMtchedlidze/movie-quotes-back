<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Quote extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['quote'];

	public function scopeFilter(Builder $query, array $filters): void
	{
		$query->when(
			$filters['quote'] ?? null,
			fn ($query, $search) => $query
				->where('quote->en', 'like', '%' . $search . '%')
				->orWhere('quote->ka', 'like', '%' . $search . '%')
		);

		$query->when(
			$filters['movie'] ?? null,
			fn ($query, $search) => $query
				->whereHas(
					'movie',
					fn ($query) => $query
						->where('movie->en', 'like', '%' . $search . '%')
						->orWhere('movie->ka', 'like', '%' . $search . '%')
				)
		);

		$query->when(
			$filters['all'] ?? null,
			fn ($query, $search) => $query
				->where('quote->en', 'like', '%' . $search . '%')
				->orWhere('quote->ka', 'like', '%' . $search . '%')
				->orWhereHas(
					'movie',
					fn ($query) => $query->where('movie->en', 'like', '%' . $search . '%')
						->orWhere('movie->ka', 'like', '%' . $search . '%')
				)
		);
	}

	public function author(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function movie(): BelongsTo
	{
		return $this->belongsTo(Movie::class);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}

	public function likes(): HasMany
	{
		return $this->hasMany(Like::class);
	}
}
