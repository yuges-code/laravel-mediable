<?php

namespace Yuges\Mediable\Manipulations;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Jobs\AbstractMediaJob;
use Yuges\Mediable\Jobs\GenerateConversionJob;
use Yuges\Mediable\Jobs\GenerateAdaptationJob;
use Yuges\Mediable\Jobs\GeneratePlaceholderJob;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaConversions;
use Yuges\Mediable\Generators\Conversion\ConversionGeneratorFactory;

class FileManipulator
{
    public function generateDerivedFiles(Media $media): void
    {
        $this
            ->generatePlaceholder($media)
            ->generateAdaptations($media)
            ->generateConversions($media);
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

    public function generatePlaceholder(Media $media): self
    {
        if (! config('mediable.placeholder.generate', false)) {
            return $this;
        }

        $this->dispatchJob(
            'placeholder',
            ['media' => $media],
            GeneratePlaceholderJob::class
        );

        return $this;
    }

    public function generateAdaptations(Media $media): self
    {
        if (! config('mediable.adaptation.generate', false)) {
            return $this;
        }

        $this->dispatchJob(
            'adaptation',
            ['media' => $media],
            GenerateAdaptationJob::class
        );

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

        $this->dispatchJob(
            'conversion',
            [
                'media' => $media,
                'conversions' => $conversions
            ],
            GenerateConversionJob::class
        );

        return $this;
    }

    protected function dispatchJob(string $type, array $arguments, string $default)
    {
        $class = config("mediable.{$type}.job", $default);

        if ((! $class) || (! is_string($class))) {
            return $this;
        }

        $job = new $class(...$arguments);

        if (! $job instanceof AbstractMediaJob) {
            return $this;
        }

        $job
            ->onQueue(config('mediable.queue.name'))
            ->onConnection(config('mediable.queue.connection'));

        config("mediable.{$type}.queue.commit") === 'after'
            ? dispatch($job)->afterCommit()
            : dispatch($job);
    }
}
