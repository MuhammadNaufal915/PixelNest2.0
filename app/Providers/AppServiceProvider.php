<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Artwork;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define Gates for authorization
        Gate::define('manage-artwork', function (User $user, Artwork $artwork) {
            return $user->id === $artwork->user_id || $user->isAdmin();
        });

        Gate::define('purchase-artwork', function (User $user, Artwork $artwork) {
            return $user->id !== $artwork->user_id && 
                   in_array($artwork->status, ['approved', 'pending']) && 
                   $artwork->is_active;
        });

        Gate::define('approve-artwork', function (User $user) {
            return $user->isAdmin();
        });
    }
}