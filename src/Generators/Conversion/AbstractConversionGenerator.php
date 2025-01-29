<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Path\PathGenerator;
use Yuges\Mediable\Generators\Name\NameGenerator;

abstract class AbstractConversionGenerator implements ConversionGenerator
{
    protected ?Media $media = null;

    protected ?PathGenerator $pathGenerator = null;

    protected ?NameGenerator $nameGenerator = null;

    public function setMedia(Media $media): ConversionGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setPathGenerator(PathGenerator $generator): ConversionGenerator
    {
        $this->pathGenerator = $generator;

        return $this;
    }

    public function setNameGenerator(NameGenerator $generator): ConversionGenerator
    {
        $this->nameGenerator = $generator;

        return $this;
    }
}
