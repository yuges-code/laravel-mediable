<?php

namespace Yuges\Mediable\Generators\Responsive\Calculator;

use Yuges\Mediable\Models\Media;

abstract class AbstractWidthCalculator implements WidthCalculator
{
    protected ?Media $media = null;

    public function setMedia(Media $media): WidthCalculator
    {
        $this->media = $media;

        return $this;
    }
}
