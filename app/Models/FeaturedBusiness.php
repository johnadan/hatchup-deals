<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedBusiness extends Model
{
    protected $fillable = [
        'business_id',
        'featured_at'
    ];

    // Relationship: A featured business belongs to a user (business)
    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }
}
