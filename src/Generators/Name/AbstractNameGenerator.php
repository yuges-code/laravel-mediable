<?php

namespace Yuges\Mediable\Generators\Name;

use Yuges\Mediable\Models\Media;

abstract class AbstractNameGenerator implements NameGenerator
{
    protected ?Media $media = null;
    protected string $separator = '_';

    public function getMedia(): Media
    {
        return $this->media;
    }

    public function setMedia(Media $media): NameGenerator
    {
        $this->media = $media;

        return $this;
    }
}
