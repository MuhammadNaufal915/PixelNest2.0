<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artwork_id',
        'order_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Validation rules
     */
    public static function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the user who wrote this review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the artwork being reviewed
     */
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }

    /**
     * Get the order this review is associated with
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Boot the model - Update artwork rating cache when review is created/updated/deleted
     */
    protected static function booted()
    {
        static::created(function ($review) {
            $review->artwork->updateRatingCache();
        });

        static::updated(function ($review) {
            $review->artwork->updateRatingCache();
        });

        static::deleted(function ($review) {
            $review->artwork->updateRatingCache();
        });
    }
}
