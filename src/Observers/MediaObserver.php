<?php

namespace Yuges\Mediable\Observers;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Managers\FileManagerFactory;

class MediaObserver
{
    public function creating(Media $media): void
    {
        if ($media->shouldSortWhenCreating()) {
            if (is_null($media->order)) {
                $media->setHighestOrderNumber();
            }
        }
    }

    public function updating(Media $media): void
    {

    }

    public function deleted(Media $media): void
    {
        if (method_exists($media, 'isForceDeleting') && ! $media->isForceDeleting()) {
            return;
        }

        FileManagerFactory::create()->removeAll($media);
    }
}
