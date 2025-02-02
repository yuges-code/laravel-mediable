<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Placeholder\PlaceholderGeneratorFactory;

class GeneratePlaceholderJob extends AbstractMediaJob
{
    public function __construct(
        public Media $media,
    ) {
    }

    public function handle(): void
    {
        PlaceholderGeneratorFactory::create($this->media)->generate($this->media);
    }
}
