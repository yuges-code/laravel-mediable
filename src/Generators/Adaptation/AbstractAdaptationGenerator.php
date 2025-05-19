<?php

namespace Yuges\Mediable\Generators\Adaptation;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Adaptation\Calculator\WidthCalculator;

abstract class AbstractAdaptationGenerator implements AdaptationGenerator
{
    protected ?Media $media = null;

    protected ?WidthCalculator $widthCalculator = null;

    public function setMedia(Media $media): AdaptationGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setWidthCalculator(WidthCalculator $calculator): AdaptationGenerator
    {
        $this->widthCalculator = $calculator;

        return $this;
    }
}
