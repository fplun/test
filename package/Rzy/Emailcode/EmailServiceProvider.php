<?php

namespace Rzy\Emailcode;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'email');
    }

    public function register()
    {

    }
}
