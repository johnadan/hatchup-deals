<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'reference_id',
    //     'type'
    // ];

    protected $fillable = [
        'user_id',
        'favoriteable_id',
        'favoriteable_type'
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function favoritable(): MorphTo
    // {
    //     return $this->morphTo();
    // }

    // Relationship: A favorite belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Polymorphic relationship: A favorite can belong to a business or deal
    public function favoriteable()
    {
        return $this->morphTo();
    }
}
