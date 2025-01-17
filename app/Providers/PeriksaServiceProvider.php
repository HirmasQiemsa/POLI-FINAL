<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Periksa;
use App\Observers\PeriksaObserver;

class PeriksaServiceProvider extends ServiceProvider
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
        Periksa::observe(PeriksaObserver::class);
    }
}
