<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['text', 'category_id'])]
class Quote extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Free-text search in the quote itself or in the publisher's name. */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        if ($term === '') {
            return $query;
        }

        $like = '%'.$term.'%';

        return $query->where(fn (Builder $q) => $q
            ->where('text', 'like', $like)
            ->orWhereHas('user', fn (Builder $u) => $u->where('name', 'like', $like)));
    }

    public function scopeOrdered(Builder $query, string $sort): Builder
    {
        return $sort === 'oldest' ? $query->oldest() : $query->latest();
    }
}
