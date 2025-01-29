<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;
use Yuges\Mediable\Generators\Name\NameGenerator;
use Yuges\Mediable\Generators\Path\PathGenerator;

interface ConversionGenerator
{
    public function setMedia(Media $media): self;

    public function generate(MediaConversion $conversion): void;

    public function setPathGenerator(PathGenerator $generator): self;

    public function setNameGenerator(NameGenerator $generator): self;

    public function getManipulations(MediaConversion $conversion): Manipulations;
}
