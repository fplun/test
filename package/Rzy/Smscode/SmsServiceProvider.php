<?php

namespace Rzy\Smscode;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/sms.php' => config_path('sms.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {

    }
}
