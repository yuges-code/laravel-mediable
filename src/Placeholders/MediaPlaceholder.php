<?php

namespace Yuges\Mediable\Placeholder;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;

class MediaPlaceholder
{
    public static function create(): self
    {
        return new static();
    }

    public function register(Media $media, MediaConversion $conversion, string $file): void
    {
        $placeholders = $media->placeholders ?? [];

        $placeholders[$conversion->getName()] = $file;

        $media->placeholders = $placeholders;

        $media->save();
    }
}
