<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Adaptation\AdaptationGenerator;
use Yuges\Mediable\Generators\Placeholder\PlaceholderGenerator;

abstract class AbstractConversionGenerator implements ConversionGenerator
{
    protected ?Media $media = null;

    protected ?AdaptationGenerator $adaptationGenerator = null;

    protected ?PlaceholderGenerator $placeholderGenerator = null;

    public function setMedia(Media $media): ConversionGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setAdaptationGenerator(AdaptationGenerator $generator): ConversionGenerator
    {
        $this->adaptationGenerator = $generator;

        return $this;
    }

    public function setPlaceholderGenerator(PlaceholderGenerator $generator): ConversionGenerator
    {
        $this->placeholderGenerator = $generator;

        return $this;
    }
}
