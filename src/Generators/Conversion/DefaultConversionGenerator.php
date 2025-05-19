<?php

namespace Yuges\Mediable\Generators\Conversion;

use Exception;
use Yuges\Mediable\Image\ImageFactory;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;

class DefaultConversionGenerator extends AbstractConversionGenerator
{
    public function generate(MediaConversion $conversion): void
    {
        if (! $this->media) {
            throw new Exception('Media model not found');
        }

        $this
            ->generateConversion($conversion)
            ->generatePlaceholder($conversion)
            ->generateAdaptations($conversion);
    }

    protected function generateConversion(MediaConversion $conversion): self
    {
        $image = ImageFactory::load(
            Storage::disk($this->media->disk)->path($this->media->getPathname())
        );
        $this->getManipulations($conversion)->apply($image);

        Storage::disk($this->media->disk)->makeDirectory($conversion->getPath($this->media));

        $filename = Storage::disk($this->media->disk)->path($conversion->getPathname($this->media));
        $image->save($filename);

        $conversion->register($this->media, $filename);

        return $this;
    }

    protected function generatePlaceholder(MediaConversion $conversion): self
    {
        if (! $conversion->getWith()['placeholder'] ?? false) {
            return $this;
        }

        $this->placeholderGenerator->generate($this->media, $conversion);

        return $this;
    }

    protected function generateAdaptations(MediaConversion $conversion): self
    {
        if (! $conversion->getWith()['adaptation'] ?? false) {
            return $this;
        }

        $this->adaptationGenerator->generate($conversion);

        return $this;
    }

    public function getManipulations(MediaConversion $conversion): Manipulations
    {
        return $conversion->getManipulations();
    }
}
