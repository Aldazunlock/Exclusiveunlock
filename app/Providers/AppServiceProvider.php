<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Booking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Booking::observe(\App\Observers\BookingObserver::class);
    }
}
