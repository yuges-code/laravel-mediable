<?php

namespace Yuges\Mediable\Providers;

use Illuminate\Support\ServiceProvider;

class MediableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/mediable.php' => config_path('mediable.php')
        ], 'mediable-config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'mediable-migrations');
    }
}
