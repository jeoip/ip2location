<?php

namespace Jeoip\Ip2Location;

use Illuminate\Support\ServiceProvider;
use Jeoip\Contracts\IGeoIPService;

class GeoIPServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IGeoIPService::class, GeoIPService::class);
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\ImportSubnet::class,
        Console\Commands\ImportAsn::class,
            ]);
        }
    }
}
