<?php

namespace Yuges\Mediable\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Yuges\Mediable\Adaptations\MediaAdaptation;

/**
 * @property ?array $adaptations
 */
trait HasAdaptations
{
    protected function initializeHasAdaptations()
    {
        /** @var Model $this */
        $this->mergeCasts(['adaptations' => 'array']);
    }

    public function getAdaptations(): ?array
    {
        return $this->adaptations;
    }

    public function getSrcset(string $conversion = 'original'): Collection
    {
        $collection = new Collection($this->adaptations[$conversion] ?? null);

        return $collection->map(function (string $filename, int $width) use ($conversion) {
            $adaptation = MediaAdaptation::create($width);

            return [
                'width' => $width,
                'url' => Storage::disk($this->disk)->url(
                    $adaptation->getPath($this) . $filename
                ),
            ];
        });
    }
}
