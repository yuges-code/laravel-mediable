<?php

namespace Yuges\Mediable\Collections;

use Illuminate\Support\Collection;

class MediaCollection extends Collection
{
    public function __construct(
        protected string $name
    ) {
        
    }

    public static function create(string $name): self
    {
        return new static($name);
    }
}
