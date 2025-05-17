<?php

namespace Yuges\Mediable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Mediable\Interfaces\Mediable;
use Yuges\Mediable\Observers\MediaObserver;
use Yuges\Mediable\Observers\MediableObserver;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'mediable';

    public static function getMediaTable(mixed $default = null): string
    {
        return self::get('models.media.table', $default);
    }

    /** @return class-string<Media> */
    public static function getMediaClass(mixed $default = null): string
    {
        return self::get('models.media.class', $default);
    }

    public static function getMediaKeyType(mixed $default = null): KeyType
    {
        return self::get('models.media.key', $default);
    }

    /** @return class-string<MediaObserver> */
    public static function getMediaObserverClass(mixed $default = null): string
    {
        return self::get('models.media.observer', $default);
    }

    public static function getMediableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.mediable.key', $default);
    }

    public static function getMediableRelationName(mixed $default = null): string
    {
        return self::get('models.mediable.relation.name', $default);
    }

    /** @return class-string<Mediable> */
    public static function getMediableDefaultClass(mixed $default = null): string
    {
        return self::get('models.mediable.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Mediable>> */
    public static function getMediableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.mediable.allowed.classes', $default)
        );
    }

    /** @return class-string<MediableObserver> */
    public static function getMediableObserverClass(mixed $default = null): string
    {
        return self::get('models.mediable.observer', $default);
    }
}
