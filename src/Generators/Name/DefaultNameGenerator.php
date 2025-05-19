<?php

namespace Yuges\Mediable\Generators\Name;

use Yuges\Mediable\Conversions\MediaConversion;

class DefaultNameGenerator extends AbstractNameGenerator
{
    public function getConversionFilename(MediaConversion $conversion): string
    {
        return $this->media->filename . $this->separator . $conversion->getName() . '.' . $this->media->extension;
    }

    public function getAdaptationFilename(MediaConversion $conversion, int $width): string
    {
        return
            $this->media->filename .
            $this->separator .
            $conversion->getName() .
            $this->separator . $width . '.' . $this->media->extension;
    }
}
