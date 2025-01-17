<?php

namespace Yuges\Mediable\Conversions;

class MediaConversion
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
