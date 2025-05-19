<?php

namespace Yuges\Mediable\Generators\Adaptation\Calculator;

use Yuges\Mediable\Models\Media;

abstract class AbstractWidthCalculator implements WidthCalculator
{
    protected ?Media $media = null;

    protected ?float $coefficient = 0.5;

    public function __construct()
    {
        $this->coefficient = (float) config('mediable.responsive.calculator.coefficient', 0.5);
    }

    public function setMedia(Media $media): WidthCalculator
    {
        $this->media = $media;

        return $this;
    }
}
