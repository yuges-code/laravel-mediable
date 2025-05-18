<?php

namespace Yuges\Mediable\Generators\Url;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Yuges\Mediable\Generators\Path\PathGenerator;

abstract class AbstractUrlGenerator implements UrlGenerator
{
    protected ?Media $media = null;

    protected ?PathGenerator $pathGenerator = null;

    public function setMedia(Media $media): UrlGenerator
    {
        $this->media = $media;

        return $this;
    }

    public function setPathGenerator(PathGenerator $pathGenerator): UrlGenerator
    {
        $this->pathGenerator = $pathGenerator;

        return $this;
    }

    protected function getDisk(): FilesystemAdapter
    {
        return Storage::disk($this->media->disk);
    }
}
