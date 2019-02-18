<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\Validator::extend('iso_date', 'Penance316\Validators\IsoDateValidator@validateIsoDate');
    }
}
