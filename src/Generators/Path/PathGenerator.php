<?php

namespace Yuges\Mediable\Generators\Path;

use Yuges\Mediable\Models\Media;

interface PathGenerator
{
    public function getPath(Media $media): string;

    public function getPathToConversions(Media $media): string;

    public function getPathToAdaptations(Media $media): string;
}
