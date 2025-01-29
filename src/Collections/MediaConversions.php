<?php

namespace Yuges\Mediable\Collections;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;
use Yuges\Mediable\Interfaces\Mediable;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Manipulations\Manipulations;

class MediaConversions extends Collection
{
    protected Media $media;

    public static function create(Media $media): self
    {
        return (new static)->setMedia($media);
    }

    public function setMedia(Media $media): self
    {
        $this->media = $media;

        /** @var \Yuges\Mediable\Interfaces\Mediable $model */
        $model = $media->mediable()->createModelByType($this->media->mediable_type);

        $this
            ->clear()
            ->addConversions($model)
            ->addManipulations($media);

        return $this;
    }

    protected function addConversions(Mediable $model): self
    {
        $model->mediaConversions()->each(fn (MediaConversion $conversion) => $this->push($conversion));

        return $this;
    }

    protected function addManipulations(Media $media): self
    {
        $media->manipulations;

        collect($media->manipulations)->each(function (array $manipulations, string $conversion) {
            $manipulations = Manipulations::create($manipulations);

            $this->addManipulationsToConversion($manipulations, $conversion);
        });

        return $this;
    }

    protected function addManipulationsToConversion(Manipulations $manipulations, string $conversion): self
    {
        /** @var MediaConversion|null $mediaConversion */
        $mediaConversion = $this->first(function (MediaConversion $mediaConversion) use ($conversion) {
            // if (! $conversion->shouldBePerformedOn($this->media->collection_name)) {
            //     return false;
            // }

            if ($mediaConversion->getName() !== $conversion) {
                return false;
            }

            return true;
        });

        if ($mediaConversion) {
            $mediaConversion->prependManipulations($manipulations);
        }

        if ($conversion === '*') {
            $this->each(
                fn (MediaConversion $mediaConversion) => $mediaConversion->prependManipulations(clone $manipulations)
            );
        }

        return $this;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }
}
