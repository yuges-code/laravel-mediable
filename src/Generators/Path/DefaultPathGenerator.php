<?php

namespace Yuges\Mediable\Generators\Path;

use Yuges\Mediable\Models\Media;

class DefaultPathGenerator implements PathGenerator
{
    const int BASE = 36;

    public function getPath(Media $media): string
    {
        return $this->getDirectory($media) . '/';
    }

    public function getPathToConversions(Media $media): string
    {
        return $this->getDirectory($media) . '/conversions/';
    }

    public function getPathToResponsive(Media $media): string
    {
        return $this->getDirectory($media) . '/responsive/';
    }

    protected function getDirectory(Media $media): string
    {
        $timestamp = base_convert($media->created_at->startOfDay()->getTimestamp() / 100, 10, self::BASE);

        return "{$timestamp}/{$media->id}";
    }
}
