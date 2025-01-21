<?php

namespace Yuges\Mediable\Conversions;

use Yuges\Mediable\Manipulations\Manipulations;

class MediaConversion
{
    protected Manipulations $manipulations;

    public function __construct(
        protected string $name
    ) {
        $this->manipulations = Manipulations::create();
    }

    public static function create(string $name): self
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setManipulations(Manipulations|array $manipulations): self
    {
        if ($manipulations instanceof Manipulations) {
            $this->manipulations = $manipulations;
        } else {
            $this->manipulations = Manipulations::create($manipulations);
        }

        return $this;
    }
}
