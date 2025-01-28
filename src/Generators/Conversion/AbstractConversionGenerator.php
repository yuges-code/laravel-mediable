<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Path\PathGenerator;

abstract class AbstractConversionGenerator implements ConversionGenerator
{
    protected ?Media $media = null;

    protected ?PathGenerator $pathGenerator = null;

    public function setMedia(Media $media): ConversionGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setPathGenerator(PathGenerator $pathGenerator): ConversionGenerator
    {
        $this->pathGenerator = $pathGenerator;

        return $this;
    }
}
