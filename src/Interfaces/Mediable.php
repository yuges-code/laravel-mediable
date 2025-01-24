<?php

namespace Yuges\Mediable\Interfaces;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;
use Yuges\Mediable\Managers\MediaManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface Mediable
{
    public function media(): MorphToMany;

    public function addMedia(string|UploadedFile $file): MediaManager;

    public function attachMedia(Media $media, string $collection = 'default'): void;

    public function getFirstMedia(string $collection = 'default'): ?Media;

    public function mediaConversions(Media $media = null): ?Collection;
}
