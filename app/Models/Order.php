<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

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

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'PN-' . strtoupper(Str::random(10));
            }
        });
    }

    /**
     * Get the user who placed this order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

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
    {
        return $this->status === 'paid';
    }

    /**
     * Check if order is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Mark order as paid
     */
    public function markAsPaid(array $paymentDetails = [])
    {
        $this->update([
            'status' => 'paid',
            'payment_details' => $paymentDetails,
        ]);
    }

    /**
     * Mark order as failed
     */
    public function markAsFailed(array $paymentDetails = [])
    {
        $this->update([
            'status' => 'failed',
            'payment_details' => $paymentDetails,
        ]);
    }
}
