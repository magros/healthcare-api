<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        setLocale(LC_ALL, 'es_MX.utf8');
        Carbon::setLocale('es_MX.utf8');
        Schema::defaultStringLength(191);
    }
}
