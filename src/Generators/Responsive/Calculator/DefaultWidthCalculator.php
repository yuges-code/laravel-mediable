<?php

namespace Yuges\Mediable\Generators\Responsive\Calculator;

use Illuminate\Support\Collection;
use Yuges\Mediable\Image\ImageFactory;
use Symfony\Component\HttpFoundation\File\File;

class DefaultWidthCalculator extends AbstractWidthCalculator
{
    public function calculate(File $file): Collection
    {
        $image = ImageFactory::load($file->getPathname());

        $width = $image->getWidth();
        $height = $image->getHeight();

        return $this->calculateWidths($file, $width, $height);
    }

    public function calculateWidths(File $file, int $width, int $height): Collection
    {
        $collection = new Collection([$width]);

        $ratio = $height / $width;
        $area = $height * $width;

        $size = $file->getSize();
        $pixelPrice = $size / $area;

        while (true) {
            $size *= 0.7;

            $newWidth = (int) floor(sqrt(($size / $pixelPrice) / $ratio));

            if ($this->finishedCalculating((int) $size, $newWidth)) {
                return $collection;
            }

            $collection->push($newWidth);
        }
    }

    protected function finishedCalculating(int $size, int $width): bool
    {
        if ($width < 20) {
            return true;
        }

        if ($size < (1024 * 10)) {
            return true;
        }

        return false;
    }
}
