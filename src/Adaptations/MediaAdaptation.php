<?php

namespace Yuges\Mediable\Adaptations;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Generators\Name\NameGeneratorFactory;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;

class MediaAdaptation
{
    public function __construct(
        protected int $width,
    ) {
    }

    public static function create(int $width): self
    {
        return new static($width);
    }

    public function getFilename(Media $media, MediaConversion $conversion): string
    {
        return NameGeneratorFactory::create($media)->getAdaptationFilename($conversion, $this->width);
    }

    public function getPath(Media $media): string
    {
        return PathGeneratorFactory::create($media)->getPathToAdaptations($media);
    }

    public function getPathname(Media $media, MediaConversion $conversion): string
    {
        return $this->getPath($media) . $this->getFilename($media, $conversion);
    }

    public function register(Media $media, MediaConversion $conversion, string $file): void
    {
        $media->refresh();

        $adaptations = $media->adaptations ?? [];

        $adaptations[$conversion->getName()][$this->width] = pathinfo($file, PATHINFO_BASENAME);

        $media->adaptations = $adaptations;

        $media->save();
    }
}
