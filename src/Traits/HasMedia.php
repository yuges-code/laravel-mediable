<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Managers\MediaManager;
use Yuges\Mediable\Collections\MediaCollection;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaCollections;
use Yuges\Mediable\Collections\MediaConversions;
use Yuges\Mediable\Managers\MediaManagerFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasMedia
{
    protected MediaCollections $mediaCollections;

    protected MediaConversions $mediaConversions;

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function addMedia(string|UploadedFile $file): MediaManager
    {
        return MediaManagerFactory::create($this, $file);
    }

    public function attachMedia(Media $media, string $collection = 'default'): void
    {
        $media->fill([
            'order' => 1,
            'collection' => $collection,
        ]);

        $this->media()->save($media);
    }

    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->media->firstWhere('collection', $collection);
    }

    public function addMediaCollection(string $name): MediaCollection
    {
        if (! isset($this->mediaCollections)) {
            $this->mediaCollections = MediaCollections::make();
        }

        $mediaCollection = MediaCollection::create($name);

        $this->mediaCollections->push($mediaCollection);

        return $mediaCollection;
    }

    public function addMediaConversion(string $name): MediaConversion
    {
        if (! isset($this->mediaConversions)) {
            $this->mediaConversions = MediaConversions::make();
        }

        $mediaConversion = MediaConversion::create($name);

        $this->mediaConversions->push($mediaConversion);

        return $mediaConversion;
    }

    public function mediaCollections(?Media $media = null): MediaCollections
    {
        return $this->mediaCollections = MediaCollections::make();
    }

    public function mediaConversions(?Media $media = null): MediaConversions
    {
        return $this->mediaConversions = MediaConversions::make();
    }
}
