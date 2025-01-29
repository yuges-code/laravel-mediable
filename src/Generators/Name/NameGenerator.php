<?php

namespace Yuges\Mediable\Generators\Name;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;

interface NameGenerator
{
    public function getMedia(): Media;

    public function setMedia(Media $media): self;

    public function getConversionFileName(MediaConversion $conversion): string;

    public function getResponsiveFileName(MediaConversion $conversion): string;
}
