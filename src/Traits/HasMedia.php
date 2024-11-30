<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;
use Yuges\Mediable\Managers\FileManager;
use Yuges\Mediable\Managers\FileManagerFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasMedia
{
    public function mediaConversions(Media $media = null): ?Collection
    {
        return null;
    }

    public function addMedia(string|UploadedFile $file): FileManager
    {
        return FileManagerFactory::create($this, $file);
    }
}
