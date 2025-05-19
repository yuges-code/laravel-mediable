<?php

namespace Yuges\Mediable\Generators\Adaptation;

use Exception;
use Yuges\Mediable\Image\ImageFactory;
use Yuges\Mediable\Enums\Manipulation;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;
use Symfony\Component\HttpFoundation\File\File;

class DefaultAdaptationGenerator extends AbstractAdaptationGenerator
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
            ->each(fn ($width) => $this->generateAdaptation($conversion, $file, $width));
    }

    public function generateAdaptation(MediaConversion $conversion, File $file, int $width): self
    {
        $image = ImageFactory::load($file->getPathname());

        $this->getManipulations($conversion, $width)->apply($image);

        $adaptation = $conversion->getAdaptation($width);

        Storage::disk($this->media->disk)->makeDirectory($adaptation->getPath($this->media));

        $filename = Storage::disk($this->media->disk)->path($adaptation->getPathname($this->media, $conversion));
        $image->save($filename);

        $adaptation->register($this->media, $conversion, $filename);

        return $this;
    }

    public function getManipulations(MediaConversion $conversion, int $width): Manipulations
    {
        return Manipulations::create([
            Manipulation::Width->value => [$width],
        ]);
    }
}
