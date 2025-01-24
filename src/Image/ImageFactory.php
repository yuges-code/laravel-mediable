<?php

namespace Yuges\Mediable\Image;

use Yuges\Image\Image;

class ImageFactory
{
    public static function load(string $path): Image
    {
        $driver = config('mediable.drivers.image');

        return Image::useDriver($driver)->loadFile($path);
    }
}
