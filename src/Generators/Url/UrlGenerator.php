<?php

namespace Yuges\Mediable\Generators\Url;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Path\PathGenerator;

interface UrlGenerator
{
    public function getUrl(): string;

    public function getPath(): string;

    public function setMedia(Media $media): self;

    public function setPathGenerator(PathGenerator $pathGenerator): self;
}
