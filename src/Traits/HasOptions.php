<?php

namespace Yuges\Mediable\Traits;

trait HasOptions
{
    protected ?string $disk = null;

    protected ?array $properties = null;

    protected bool $temporary = false;

    protected ?array $manipulations = null;

    protected bool $responsive = false;

    protected ?string $collection = null;

    protected bool $preserveSource = false;

    public function setDisk(?string $disk = null): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function setProperties(array $properties): self
    {
        $this->properties = $properties;
        
        return $this;
    }

    public function setCollection(?string $collection = null): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function setManipulations(array $manipulations): self
    {
        $this->manipulations = $manipulations;

        return $this;
    }

    public function preserveSource(bool $preserve = false): self
    {
        $this->preserveSource = $preserve;

        return $this;
    }

    public function responsive(bool $responsive = true): self
    {
        $this->responsive = $responsive;

        return $this;
    }

    public function temporary(bool $temporary = true): self
    {
        $this->temporary = $temporary;

        return $this;
    }
}
