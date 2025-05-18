<?php

namespace Yuges\Mediable\Generators\Responsive;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Responsive\Calculator\WidthCalculator;

abstract class AbstractResponsiveGenerator implements ResponsiveGenerator
{
    protected ?Media $media = null;

    protected ?WidthCalculator $widthCalculator = null;

    public function setMedia(Media $media): ResponsiveGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setWidthCalculator(WidthCalculator $calculator): ResponsiveGenerator
    {
        $this->widthCalculator = $calculator;

        return $this;
    }
}
