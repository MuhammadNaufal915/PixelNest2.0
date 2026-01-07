<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'artwork_id',
    ];

    /**
     * Get the cart this item belongs to
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the artwork
     */
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
