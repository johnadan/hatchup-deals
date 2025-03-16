<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deal extends Model
{
    /** @use HasFactory<\Database\Factories\DealFactory> */
    use HasFactory;

    protected $fillable = [
        'business_id',
        'category_id',
        'title',
        'description',
        'original_price',
        'discounted_price',
        'start_date',
        'end_date',
        'max_usage_limit',
        'current_usage_count',
        'is_active',
        'is_featured',
        'type',
        'image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // public function customers(): BelongsToMany
    // {
    //     return $this->belongsToMany(Customer::class, 'customer_deal')->withPivot('purchase_date', 'quantity'); // Example pivot fields
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // public function claimedDeals()
    // {
    //     return $this->hasMany(ClaimedDeal::class);
    // }
    // public function dealClaims(): HasMany
    // {
    //     return $this->hasMany(DealClaim::class);
    // }
    // public function favorites(): MorphMany
    // {
    //     return $this->morphMany(Favorite::class, 'favoritable');
    // }

     // Relationship: A deal can be favorited by users
     public function favorites()
     {
         return $this->morphMany(Favorite::class, 'favoriteable');
     }

     // Relationship: A deal can be featured by a business
     public function featuredDeal()
     {
         return $this->hasOne(FeaturedDeal::class);
     }

    // Relationship: A deal belongs to a business
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    // Relationship: A deal can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getRemainingClaimsAttribute()
    {
        return $this->max_usage_limit - $this->current_usage_count;
    }

}
