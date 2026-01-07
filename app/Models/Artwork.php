<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use HasFactory, SoftDeletes;

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

    /**
     * Get the user who uploaded this artwork
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of this artwork
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get order items for this artwork
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

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
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for active artworks
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for available artworks (approved and active)
     */
    public function scopeAvailable($query)
    {
        return $query->approved()->active();
    }

    /**
     * Get full image URL
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Get full file URL
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Increment downloads count
     */
    public function incrementDownloads()
    {
        $this->increment('downloads_count');
    }
}
