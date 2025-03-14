<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Deal;
use App\Policies\DealPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Deal::class, DealPolicy::class);
    }
}
