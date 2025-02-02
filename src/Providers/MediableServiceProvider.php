<?php

namespace Yuges\Mediable\Providers;

use Exception;
use Yuges\Mediable\Models\Media;
use Illuminate\Support\ServiceProvider;
use Yuges\Mediable\Observers\MediaObserver;

class MediableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var Media */
        $class = config('mediable.models.media', Media::class);

        if (! is_a(new $class, Media::class)) {
            throw new Exception('Invalid media model');
        }

        $class::observe(new MediaObserver);

        $this->publishes([
            __DIR__.'/../../config/mediable.php' => config_path('mediable.php')
        ], 'mediable-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'mediable-migrations');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'mediable');
    }
}
