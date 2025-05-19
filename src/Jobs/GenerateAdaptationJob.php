<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Responsive\ResponsiveGeneratorFactory;

class GenerateAdaptationJob extends AbstractMediaJob
{
    public function __construct(
        public Media $media,
    ) {
    }

    public function handle(): void
    {
        ResponsiveGeneratorFactory::create($this->media)->generate();
    }
}
