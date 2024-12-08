<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;
use Yuges\Mediable\Models\Mediable;
use Yuges\Mediable\Managers\FileManager;
use Yuges\Mediable\Managers\FileManagerFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasMedia
{
    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable')->using(Mediable::class);
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
        return $this->media->first();
    }

    public function mediaConversions(Media $media = null): ?Collection
    {
        return null;
    }
}
