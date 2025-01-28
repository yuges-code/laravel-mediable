<?php

namespace Yuges\Mediable\Manipulations;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Jobs\GenerateConversionJob;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaConversions;
use Yuges\Mediable\Generators\Conversion\ConversionGeneratorFactory;

class FileManipulator
{
    public function generateDerivedFiles(Media $media): void
    {
        $this
            ->generateConversions($media)
            ->generatePlaceholders($media)
            ->generateResponsive($media);
    }

    public function generateConversions(Media $media): self
    {
        [$executable, $dispatchable] = MediaConversions::create($media)
            ->filter(fn (MediaConversion $conversion) => $conversion->containsCollection($media->collection))
            ->partition(fn (MediaConversion $conversion) => $conversion->getQueued());

        return $this
            ->executeConversions($media, $executable)
            ->dispatchConversions($media, $dispatchable);
    }

    public function generatePlaceholders(Media $media): self
    {
        return $this;
    }

    public function generateResponsive(Media $media): self
    {
        return $this;
    }

    public function executeConversions(Media $media, MediaConversions $conversions): self
    {
        if ($conversions->isEmpty()) {
            return $this;
        }

        $conversions->each(fn (MediaConversion $conversion) =>
            ConversionGeneratorFactory::create($media)->generate($conversion)
        );

        return $this;
    }

    public function dispatchConversions(Media $media, MediaConversions $conversions): self
    {
        if ($conversions->isEmpty()) {
            return $this;
        }

        $job = new GenerateConversionJob($media, $conversions);

        dispatch($job);

        return $this;
    }
}
