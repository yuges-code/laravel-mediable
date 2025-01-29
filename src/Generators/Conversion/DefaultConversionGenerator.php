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

        $filename = $this->getFilename($conversion);
        $image->save($filename);

        $conversion->register($this->media, $filename);
    }

    public function getFilename(MediaConversion $conversion): string
    {
        $name = $this->nameGenerator->getConversionFileName($conversion);
        $path = $this->pathGenerator->getPathToConversions($this->media);

        Storage::disk($this->media->disk)->makeDirectory($path);

        return Storage::disk($this->media->disk)->path($path . $name);
    }

    public function getManipulations(MediaConversion $conversion): Manipulations
    {
        return $conversion->getManipulations();
    }
}
