<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Models\Mediable;
use Yuges\Mediable\Managers\FileManager;
use Yuges\Mediable\Managers\FileManagerFactory;
use Yuges\Mediable\Collections\MediaCollection;
use Yuges\Mediable\Conversions\MediaConversion;
use Yuges\Mediable\Collections\MediaCollections;
use Yuges\Mediable\Collections\MediaConversions;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasMedia
{
    protected MediaCollections $mediaCollections;

    protected MediaConversions $mediaConversions;

    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable')->using(Mediable::class)->withPivot('collection', 'order');
    }

    public function addMedia(string|UploadedFile $file): FileManager
    {
        return FileManagerFactory::create($this, $file);
    }

    public function attachMedia(Media $media, string $collection = 'default'): void
    {
        $this->media()->attach($media, [
            'order' => 1,
            'collection' => $collection,
        ]);
    }

    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->media->firstWhere('pivot.collection', $collection);
    }

    public function addMediaCollection(string $name): MediaCollection
    {
        if (! $this->mediaCollections) {
            $this->mediaCollections = MediaCollections::make();
        }

        $mediaCollection = MediaCollection::create($name);

        $this->mediaCollections->push($mediaCollection);

        return $mediaCollection;
    }

    public function addMediaConversion(string $name): MediaConversion
    {
        if (! $this->mediaConversions) {
            $this->mediaConversions = MediaConversions::make();
        }

        $mediaConversion = MediaConversion::create($name);

        $this->mediaConversions->push($mediaConversion);

        return $mediaConversion;
    }

    public function mediaCollection(?Media $media = null): MediaCollections
    {
        return $this->mediaCollections = MediaCollections::make();
    }

    public function mediaConversions(?Media $media = null): MediaConversions
    {
        return $this->mediaConversions = MediaConversions::make();
    }
}
