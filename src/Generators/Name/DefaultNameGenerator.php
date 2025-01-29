<?php

namespace Yuges\Mediable\Generators\Name;

use Yuges\Mediable\Conversions\MediaConversion;

class DefaultNameGenerator extends AbstractNameGenerator
{
    public function getConversionFileName(MediaConversion $conversion): string
    {
        return $this->media->filename . $this->separator . $conversion->getName() . '.' . $this->media->extension;
    }

    public function getResponsiveFileName(MediaConversion $conversion): string
    {
        return $this->media->filename . $this->separator . $conversion->getName() . '.' . $this->media->extension;
    }
}
