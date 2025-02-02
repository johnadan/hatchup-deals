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

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

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
    public function dealClaims(): HasMany
    {
        return $this->hasMany(DealClaim::class);
    }
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
