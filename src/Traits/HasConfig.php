<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Models\Mediable;

trait HasConfig
{
    public function getDisk()
    {

    }

    public static function getMediaClass(): string
    {
        return config('mediable.models.media');
    }

    public static function createMedia(): Media
    {
        $class = self::getMediaClass();

        return new $class;
    }

    public static function getMediaTable(): string
    {
        return self::createMedia()->getTable();
    }

    public static function getMediableClass(): string
    {
        return config('mediable.models.mediable');
    }

    public static function createMediable(): Mediable
    {
        $class = self::getMediableClass();

        return new $class;
    }

    public static function getMediableTable(): string
    {
        return self::createMediable()->getTable();
    }
}
