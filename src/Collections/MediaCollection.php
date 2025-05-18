<?php

namespace Yuges\Mediable\Collections;

class MediaCollection
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
