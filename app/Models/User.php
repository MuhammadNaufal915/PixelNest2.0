<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isBanned()
    {
        return false;
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

<<<<<<< HEAD
    /**
     * Get user's reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if user has purchased a specific artwork
     */
    public function hasPurchased(Artwork $artwork): bool
    {
        return $this->orders()
            ->where('status', 'paid')
            ->whereHas('items', function ($query) use ($artwork) {
                $query->where('artwork_id', $artwork->id);
            })
            ->exists();
    }
}
=======
    public function purchasedArtworks()
    {
        return $this->belongsToMany(Artwork::class, 'order_items')
            ->withPivot('price')
            ->withTimestamps();
    }
}
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
