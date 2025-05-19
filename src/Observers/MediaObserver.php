<?php

namespace Yuges\Mediable\Observers;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Managers\FileManagerFactory;

class MediaObserver
{
    public function creating(Media $media): void
    {
        # code...
    }

    public function updating(Media $media): void
    {
        # code...
    }

    public function deleted(Media $media): void
    {
        if (method_exists($media, 'isForceDeleting') && ! $media->isForceDeleting()) {
            return;
        }

        FileManagerFactory::create()->removeAll($media);
    }
}
