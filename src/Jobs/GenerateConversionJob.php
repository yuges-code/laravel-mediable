<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaConversions;
use Yuges\Mediable\Generators\Conversion\ConversionGeneratorFactory;

class GenerateConversionJob extends AbstractMediaJob
{
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
