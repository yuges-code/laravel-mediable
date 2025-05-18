<?php

namespace Yuges\Mediable\Placeholders;

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
        $media->refresh();

        $placeholders = $media->placeholders ?? [];

        $placeholders[$conversion->getName()] = $file;

        $media->placeholders = $placeholders;

        $media->save();
    }
}
