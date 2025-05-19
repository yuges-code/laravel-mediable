<?php

namespace Yuges\Mediable\Generators\Adaptation;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;;
use Yuges\Mediable\Generators\Adaptation\Calculator\WidthCalculator;

interface ResponsiveGenerator
{
    public function setMedia(Media $media): self;

    public function generate(?MediaConversion $conversion = null): void;

    public function setWidthCalculator(WidthCalculator $calculator): self;

    public function getManipulations(MediaConversion $conversion, int $width): Manipulations;
}
