<?php

namespace Yuges\Mediable\Generators\Adaptation;

use Exception;
use Yuges\Mediable\Image\ImageFactory;
use Yuges\Mediable\Enums\Manipulation;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;
use Symfony\Component\HttpFoundation\File\File;

class DefaultAdaptationGenerator extends AbstractResponsiveGenerator
{
    public function generate(?MediaConversion $conversion = null): void
    {
        if (! $this->media) {
            throw new Exception('Media model not found');
        }

        $conversion = $conversion ?? MediaConversion::create('original');

        $file = new File(
            Storage::disk($this->media->disk)->path($conversion->getPathname($this->media))
        );

        $this->widthCalculator
            ->calculate($file)
            ->each(fn ($width) => $this->generateResponsiveImage($conversion, $file, $width));
    }

    public function generateResponsiveImage(MediaConversion $conversion, File $file, int $width): self
    {
        $image = ImageFactory::load($file->getPathname());

        $this->getManipulations($conversion, $width)->apply($image);

        $responvive = $conversion->getResponsive($width);

        Storage::disk($this->media->disk)->makeDirectory($responvive->getPath($this->media));

        $filename = Storage::disk($this->media->disk)->path($responvive->getPathname($this->media, $conversion));
        $image->save($filename);

        $responvive->register($this->media, $conversion, $filename);

        return $this;
    }

    public function getManipulations(MediaConversion $conversion, int $width): Manipulations
    {
        return Manipulations::create([
            Manipulation::Width->value => [$width],
        ]);
    }
}
