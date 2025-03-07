<?php

namespace Yuges\Mediable\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Responsive\MediaResponsive;

/**
 * @property ?array $responsive
 */
trait HasResponsive
{
    public function getResponsive(): ?array
    {
        return $this->responsive;
    }

    public function getSrcset(string $conversion = 'original'): Collection
    {
        $collection = new Collection($this->responsive[$conversion] ?? null);

        return $collection->map(function (string $filename, int $width) use ($conversion) {
            $responsive = MediaResponsive::create($width);

            return [
                'width' => $width,
                'url' => Storage::disk($this->disk)->url(
                    $responsive->getPath($this) . $filename
                ),
            ];
        });
    }
}
