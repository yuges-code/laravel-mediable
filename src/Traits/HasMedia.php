<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Interfaces\Mediable;
use Yuges\Mediable\Managers\MediaManager;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    protected bool $deleteMedia = true;

    public static function bootHasMedia(): void
    {
        static::deleting(function (Mediable $model) {
            if (! $model->shouldDeleteMedia()) {
                return;
            }

            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (! $model->forceDeleting) {
                    return;
                }
            }

            $model->media()->cursor()->each(fn (Media $media) => $media->forceDelete());
        });
    }

    public function shouldDeleteMedia(): bool
    {
        return $this->deleteMedia;
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function addMedia(string|UploadedFile $file): MediaManager
    {
        return MediaManagerFactory::create($this, $file);
    }

    public function attachMedia(Media $media): void
    {
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
