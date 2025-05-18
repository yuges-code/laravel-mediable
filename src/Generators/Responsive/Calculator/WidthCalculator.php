<?php

namespace Yuges\Mediable\Generators\Responsive\Calculator;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\File;

interface WidthCalculator
{
    public function setMedia(Media $media): self;

    public function calculate(File $file): Collection;
}
