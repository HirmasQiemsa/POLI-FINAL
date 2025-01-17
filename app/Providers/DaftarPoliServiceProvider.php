<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DaftarPoli;
use App\Observers\DaftarPoliObserver;

class DaftarPoliServiceProvider extends ServiceProvider
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
        DaftarPoli::observe(DaftarPoliObserver::class);
    }
}
