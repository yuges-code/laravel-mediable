<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;
use Yuges\Mediable\Generators\Adaptation\AdaptationGenerator;
use Yuges\Mediable\Generators\Placeholder\PlaceholderGenerator;

interface ConversionGenerator
{
    public function setMedia(Media $media): self;

    public function generate(MediaConversion $conversion): void;

    public function getManipulations(MediaConversion $conversion): Manipulations;

    public function setAdaptationGenerator(AdaptationGenerator $generator): self;

    public function setPlaceholderGenerator(PlaceholderGenerator $generator): self;
}
