<?php

namespace Yuges\Mediable\Observers;

use Yuges\Mediable\Models\Media;

class MediableObserver
{
    public function creating(Media $model): void
    {
        
        dd($model);
    }

    public function updating(Media $model): void
    {

    }

    public function deleted(Media $media): void
    {

    }
}
