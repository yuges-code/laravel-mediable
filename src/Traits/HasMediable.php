<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Mediable\Interfaces\Mediable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $mediable_type
 * @property int|string $mediable_id
 * 
 * @property ?Mediable $mediable
 */
trait HasMediable
{
    public function mediable(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getMediableRelationName('mediable'));
    }
}
