<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'deal_id',
        'order_date',
        'total_price',
        'payment_status',
        'payment_id'
    ];

    // Relationship: An order belongs to a customer (user)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relationship: An order belongs to a deal
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    // Relationship: An order has one deal code
    public function dealCode()
    {
        return $this->hasOne(DealCode::class);
    }
}
