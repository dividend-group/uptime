<?php

namespace DividendGroup\Uptime;

use Illuminate\Support\ServiceProvider;

class UptimeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Uptime::class, function(){
            return new  Uptime();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/uptime.php' => config_path('uptime.php')
        ]);
    }
}