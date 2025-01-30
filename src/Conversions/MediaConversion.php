<?php

namespace Yuges\Mediable\Conversions;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Manipulations\Manipulation;
use Yuges\Mediable\Manipulations\Manipulations;
use Yuges\Mediable\Placeholders\MediaPlaceholder;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;
use Yuges\Mediable\Generators\Name\NameGeneratorFactory;

class MediaConversion
{
    protected bool $queued;
    protected array $collections = [];
    protected Manipulations $manipulations;

    public function __construct(
        protected string $name
    ) {
        $this->queued = config('mediable.conversion.queue.default', true);
        $this->manipulations = Manipulations::create();
    }

    public static function create(string $name): self
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function queued(bool $queued = true): self
    {
        $this->queued = $queued;

        return $this;
    }

    public function getQueued(): bool
    {
        return $this->queued;
    }

    public function setCollections(string ...$collections): self
    {
        $this->collections = $collections;

        return $this;
    }

    public function getCollections(): array
    {
        return $this->collections;
    }

    public function containsCollection(string $collection): bool
    {
        if (! count($this->collections)) {
            return true;
        }

        return in_array($collection, $this->collections);
    }

    public function setManipulations(Manipulations|array $manipulations): self
    {
        if ($manipulations instanceof Manipulations) {
            $this->manipulations = $manipulations;
        } else {
            $this->manipulations = Manipulations::create($manipulations);
        }

        return $this;
    }

    public function getManipulations(): Manipulations
    {
        return $this->manipulations;
    }

    public function prependManipulations(Manipulations|array $manipulations): self
    {
        if (is_array($manipulations)) {
            $manipulations = Manipulations::create($manipulations);
        }

        $this->manipulations->each(function (Manipulation $manipulation) use ($manipulations) {
            if ($manipulations->find($manipulation->method)) {
                return;
            }

            $manipulations->push($manipulation);
        });

        return $this->setManipulations($manipulations);
    }

    public function getFilename(Media $media): string
    {
        return NameGeneratorFactory::create($media)->getConversionFilename($this);
    }

    public function getPath(Media $media): string
    {
        return PathGeneratorFactory::create($media)->getPathToConversions($media);
    }

    public function getPathname(Media $media): string
    {
        return $this->getPath($media) . $this->getFilename($media);
    }

    public function getPlaceholder(): MediaPlaceholder
    {
        return MediaPlaceholder::create();
    }

    public function register(Media $media, string $file): void
    {
        $conversions = $media->conversions ?? [];

        $conversions[$this->name] = pathinfo($file, PATHINFO_BASENAME);

        $media->conversions = $conversions;

        $media->save();
    }
}
