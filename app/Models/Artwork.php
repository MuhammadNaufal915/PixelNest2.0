<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'price',
        'image_path',
        'file_path',
        'status',
        'is_active',
        'downloads_count',
        'average_rating',
        'reviews_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'downloads_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

<<<<<<< HEAD
    /**
     * Get reviews for this artwork
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Update rating cache from reviews
     */
    public function updateRatingCache()
    {
        $this->update([
            'average_rating' => $this->reviews()->avg('rating'),
            'reviews_count' => $this->reviews()->count(),
        ]);
    }

    /**
     * Scope for approved artworks
     */
    public function scopeApproved($query)
=======
    public function cartItems()
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
    {
        return $this->hasMany(CartItem::class);
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}