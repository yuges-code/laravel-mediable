<?php

namespace Yuges\Mediable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Config\Config;
use Yuges\Mediable\Observers\MediaObserver;
use Yuges\Mediable\Exceptions\InvalidMedia;

class MediableServiceProvider extends \Yuges\Package\Providers\PackageServiceProvider
{
    protected string $name = 'laravel-mediable';

    public function configure(Package $package): void
    {
        $media = Config::getMediaClass(Media::class);

        if (! is_a($media, Media::class, true)) {
            throw InvalidMedia::doesNotImplementMedia($media);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('mediable')
            ->hasMigrations([
                'create_media_table',
            ])
            ->loadViews(true)
            ->hasViews('mediable')
            ->hasObserver($media, Config::getMediaObserverClass(MediaObserver::class));
    }
}
