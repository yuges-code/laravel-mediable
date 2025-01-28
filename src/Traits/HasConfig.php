<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;

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
}
