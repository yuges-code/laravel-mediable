<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Models\Media;

trait HasOptions
{
    protected ?string $disk = null;

    protected array $properties = [];

    protected array $manipulations = [];

    protected bool $responsive = false;

    protected ?string $collection = null;

    protected bool $preserveOriginal = false;

    public function setDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function setProperties(array $properties): self
    {
        $this->properties = $properties;
        
        return $this;
    }

    public function setCollection(string $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function setManipulations(array $manipulations): self
    {
        $this->manipulations = $manipulations;

        return $this;
    }

    public function preserveOriginal(bool $preserve = false): self
    {
        $this->preserveOriginal = $preserve;

        return $this;
    }

    public function responsive(bool $responsive = true): self
    {
        $this->responsive = $responsive;

        return $this;
    }
}
