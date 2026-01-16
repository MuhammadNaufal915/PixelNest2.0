<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'payment_details',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

<<<<<<< HEAD
    /**
     * Get reviews from this order
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if order is paid
     */
    public function isPaid(): bool
=======
    public function isPaid()
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
    {
        return $this->status === 'paid';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}