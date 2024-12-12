<?php

namespace Yuges\Mediable\Generators\Url;

use Yuges\Mediable\Generators\Path\PathGenerator;
use Yuges\Mediable\Models\Media;

interface UrlGenerator
{
    public function getUrl(): string;

    public function getPath(): string;

    public function setMedia(Media $media): self;

    public function setPathGenerator(PathGenerator $pathGenerator): self;
}
