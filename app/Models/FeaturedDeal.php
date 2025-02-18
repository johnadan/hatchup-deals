<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedDeal extends Model
{
    protected $fillable = [
        'deal_id',
        'featured_at'
    ];

    // Relationship: A featured deal belongs to a deal
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
