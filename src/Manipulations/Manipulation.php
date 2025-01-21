<?php

namespace Yuges\Mediable\Manipulations;

use Yuges\Mediable\Enums\Manipulation as ManipulationEnum;

class Manipulation
{
    public function __construct(
        public ManipulationEnum $method,
        public array $parameters = []
    ) {
    }

    public static function create(ManipulationEnum $method, array $parameters = []): self
    {
        return new static($method, $parameters);
    }

    public function merge(array $parameters = []): self
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }
}
