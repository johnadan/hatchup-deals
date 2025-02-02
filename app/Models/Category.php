<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'display_name',
    ];

    // public function businesses(): BelongsToMany
    // {
    //     return $this->belongsToMany(Business::class, 'business_category');
    // }
    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }

    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }
}
