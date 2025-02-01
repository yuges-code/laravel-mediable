<?php

namespace Yuges\Mediable\Responsive;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Generators\Name\NameGeneratorFactory;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;

class MediaResponsive
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
        return NameGeneratorFactory::create($media)->getResponsiveFilename($conversion, $this->width);
    }

    public function getPath(Media $media): string
    {
        return PathGeneratorFactory::create($media)->getPathToResponsive($media);
    }

    public function getPathname(Media $media, MediaConversion $conversion): string
    {
        return $this->getPath($media) . $this->getFilename($media, $conversion);
    }

    public function register(Media $media, MediaConversion $conversion, string $file): void
    {
        $media->refresh();

        $responsive = $media->responsive ?? [];

        $responsive[$conversion->getName()][$this->width] = pathinfo($file, PATHINFO_BASENAME);

        $media->responsive = $responsive;

        $media->save();
    }
}
