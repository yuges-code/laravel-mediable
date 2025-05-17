<?php

namespace Yuges\Mediable\Interfaces;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Managers\MediaManager;
use Yuges\Mediable\Collections\MediaCollections;
use Yuges\Mediable\Collections\MediaConversions;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface Mediable
{
    public function media(): MorphMany;

    public function addMedia(string|UploadedFile $file): MediaManager;

    public function attachMedia(Media $media): void;

    public function getFirstMedia(string $collection = 'default'): ?Media;

    public function mediaCollections(?Media $media = null): MediaCollections;

    public function mediaConversions(?Media $media = null): MediaConversions;

    public function shouldDeleteMedia(): bool;
}
