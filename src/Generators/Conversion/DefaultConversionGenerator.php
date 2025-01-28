<?php

namespace Yuges\Mediable\Generators\Conversion;

use Exception;
use Yuges\Mediable\Image\ImageFactory;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;

class DefaultConversionGenerator extends AbstractConversionGenerator
{
    public function generate(MediaConversion $conversion): void
    {
        if (! $this->media) {
            throw new Exception('Media model not found');
        }

        $image = ImageFactory::load(
            Storage::disk($this->media->disk)->path($this->media->getPathname())
        );
        
        $this->getManipulations($conversion)->apply($image);

        $path = Storage::disk($this->media->disk)
            ->path($this->pathGenerator->getPathToConversions($this->media) . $this->media->filename . '-' . $conversion->getName() . $this->media->extension);

        $image->save($path);

        if ($this->media->conversions == null) {
            $this->media->conversions = [];
        }

        $this->media->conversions[$conversion->getName()] = true;
        $this->media->save();
    }

    public function getManipulations(MediaConversion $conversion): Manipulations
    {
        return $conversion->getManipulations();
    }
}
