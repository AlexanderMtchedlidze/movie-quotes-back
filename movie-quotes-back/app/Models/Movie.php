<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['movie', 'director', 'description'];

	public function author(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function quotes(): hasMany
	{
		return $this->hasMany(Quote::class);
	}

	public function genres(): BelongsToMany
	{
		return $this->belongsToMany(Genre::class, 'genre_movies');
	}

	public function scopeFilter(Builder $query, array $filters): void
	{
		$query->when(
			$filters['movie'] ?? null,
			fn ($query, $search) => $query
				->where('movie->en', 'like', '%' . $search . '%')
				->orWhere('movie->ka', 'like', '%' . $search . '%')
		);
	}
}
