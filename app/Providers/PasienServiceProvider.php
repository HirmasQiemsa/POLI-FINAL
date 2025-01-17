<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pasien;
use App\Observers\PasienObserver;

class PasienServiceProvider extends ServiceProvider
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
        Pasien::observe(PasienObserver::class);
    }
}
