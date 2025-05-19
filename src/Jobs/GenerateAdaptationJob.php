<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Adaptation\AdaptationGeneratorFactory;

class GenerateAdaptationJob extends AbstractMediaJob
{
    public function __construct(
        public Media $media,
    ) {
    }

    public function handle(): void
    {
        AdaptationGeneratorFactory::create($this->media)->generate();
    }
}
