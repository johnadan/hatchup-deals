<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'city_id',
        'category_id',
        'is_featured',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // public function categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Category::class, 'business_category');
    // }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

     // Relationship: A business has many users
     public function users()
     {
         return $this->hasMany(User::class);
     }

     // Relationship: A business has many deals
     public function deals()
     {
         return $this->hasMany(Deal::class);
     }
}
