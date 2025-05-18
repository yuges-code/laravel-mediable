<?php

namespace Yuges\Mediable\Exceptions;

use Exception;
use TypeError;
use Yuges\Mediable\Models\Media;

class InvalidMedia extends Exception
{
    public static function doesNotImplementMedia(string $class): TypeError
    {
        $media = Media::class;

        return new TypeError("Media class `{$class}` must implement `{$media}`");
    }
}
