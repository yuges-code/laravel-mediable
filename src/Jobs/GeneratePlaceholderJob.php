<?php

namespace Yuges\Mediable\Jobs;

use Yuges\Mediable\Models\Media;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Yuges\Mediable\Generators\Placeholder\PlaceholderGeneratorFactory;

class GeneratePlaceholderJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Media $media,
    ) {
    }

    public function handle(): void
    {
        $generator = PlaceholderGeneratorFactory::create($this->media);

        $generator->generate($this->media);
    }
}
