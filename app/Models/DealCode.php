<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealCode extends Model
{
    /** @use HasFactory<\Database\Factories\DealCodeFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'deal_code',
        'is_claimed',
        // 'claimed_at'
    ];

    // Relationship: A deal code belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
