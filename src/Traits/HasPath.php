<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Generators\Path\PathGenerator;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;

trait HasPath
{
    public function getPath(): string
    {
        return $this->getPathGenerator()->getPath($this);
    }

    public function getPathname(?string $conversion = null): string
    {
        return $this->getPath() . $this->filename . '.' . $this->extension;
    }

    public function getPathGenerator(): PathGenerator
    {
        return PathGeneratorFactory::create($this);
    }
}
