<?php

namespace Yuges\Mediable\Generators\Name;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;

interface NameGenerator
{
    public function getMedia(): Media;

    public function setMedia(Media $media): self;

    public function getConversionFilename(MediaConversion $conversion): string;

    public function getResponsiveFilename(MediaConversion $conversion, int $width): string;
}
