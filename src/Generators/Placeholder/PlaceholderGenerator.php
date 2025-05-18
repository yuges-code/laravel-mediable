<?php

namespace Yuges\Mediable\Generators\Placeholder;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;

interface PlaceholderGenerator
{
    public function generate(Media $media, ?MediaConversion $conversion = null): void;

    public function getManipulations(Media $media): Manipulations;
}
