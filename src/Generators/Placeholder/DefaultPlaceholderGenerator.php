<?php

namespace Yuges\Mediable\Generators\Placeholder;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Image\ImageFactory;
use Yuges\Mediable\Enums\Manipulation;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;

class DefaultPlaceholderGenerator implements PlaceholderGenerator
{
    public function generate(Media $media, ?MediaConversion $conversion = null): void
    {
        $conversion = $conversion ?? MediaConversion::create('original');

        $image = ImageFactory::load(
            Storage::disk($media->disk)->path($media->getPathname())
        );
        $size = $image->getSize();

        $this->getManipulations($media)->apply($image);

        $svg = view('mediable::placeholderSvg', [
            'width' => $size->width,
            'height' => $size->height,
            'data' => $image->base64('jpeg'),
        ]);
        $svg = 'data:image/svg+xml;base64,' . base64_encode((string) $svg);

        $conversion->getPlaceholder()->register($media, $conversion, $svg);
    }

    public function getManipulations(Media $media): Manipulations
    {
        return Manipulations::create([
            Manipulation::Width->value => [32],
            Manipulation::Blur->value => [20],
        ]);
    }
}
