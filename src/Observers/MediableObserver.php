<?php

namespace Yuges\Mediable\Observers;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Interfaces\Mediable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediableObserver
{
    public function deleting(Mediable $model): void
    {
        if (! $model->shouldDeleteMedia()) {
            return;
        }

        if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
            /** @var SoftDeletes $model */
            if (! $model->isForceDeleting()) {
                return;
            }
        }

        $model->media()->cursor()->each(fn (Media $media) => $media->forceDelete());
    }
}
