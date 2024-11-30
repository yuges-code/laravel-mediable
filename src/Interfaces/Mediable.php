<?php

namespace Yuges\Mediable\Interfaces;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Collection;

interface Mediable
{
    public function mediaConversions(Media $media = null): ?Collection;
}
