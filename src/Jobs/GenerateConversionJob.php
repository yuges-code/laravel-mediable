<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaConversions;
use Yuges\Mediable\Generators\Conversion\ConversionGeneratorFactory;

class GenerateConversionJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Media $media,
        public MediaConversions $conversions,
    ) {
    }

    public function handle(): void
    {
        $this->conversions->each(fn (MediaConversion $conversion) =>
            ConversionGeneratorFactory::create($this->media)->generate($conversion)
        );
    }
}
