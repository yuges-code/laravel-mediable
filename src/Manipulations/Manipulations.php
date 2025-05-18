<?php

namespace Yuges\Mediable\Manipulations;

use TypeError;
use Traversable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Yuges\Image\Image;
use Illuminate\Support\Collection;
use Yuges\Mediable\Enums\Manipulation as ManipulationEnum;

class Manipulations implements IteratorAggregate, ArrayAccess
{
    /** @var array<int, Manipulation> */
    protected array $manipulations = [];

    /**
     * @param array<string, array> $manipulations
     */
    public function __construct(array $manipulations = [])
    {
        foreach ($manipulations as $method => $parameters) {
            $this->add($method, $parameters);
        }
    }

    /**
     * @param array<string, array> $manipulations
     */
    public static function create(array $manipulations = []): self
    {
        return new static($manipulations);
    }

    public function add(ManipulationEnum|string $method, array $parameters = []): self
    {
        if (is_string($method)) {
            $method = ManipulationEnum::from($method);
        }

        $this->offsetSet(null, Manipulation::create($method, $parameters));

        return $this;
    }

    public function push(Manipulation $manipulation): self
    {
        $this->offsetSet(null, $manipulation);

        return $this;
    }

    public function remove(ManipulationEnum $method): self
    {
        foreach ($this->manipulations as $key => $item) {
            if ($item->method === $method) {
                unset($this->manipulations[$key]);
            }
        }

        return $this;
    }

    public function merge(Manipulations $manipulations): self
    {
        foreach ($manipulations->all() as $manipulation) {
            $key = $this->findKey($manipulation->method);

            if (is_null($key)) {
                $this->push($manipulation);
            } else {
                $this->manipulations[$key]->merge($manipulation->parameters);
            }
        }

        return $this;
    }

    public function find(ManipulationEnum $method): ?Manipulation
    {
        foreach ($this->manipulations as $key => $item) {
            if ($item->method === $method) {
                return $this->manipulations[$key];
            }
        }

        return null;
    }

    public function findKey(ManipulationEnum $method): ?int
    {
        foreach ($this->manipulations as $key => $item) {
            if ($item->method === $method) {
                return $key;
            }
        }

        return null;
    }

    public function each(callable $callback): self
    {
        foreach ($this as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    public function apply(Image $image): void
    {
        foreach ($this->manipulations as $manipulation) {
            $image->{$manipulation->method->value}(...$manipulation->parameters);
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->manipulations);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->manipulations[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->manipulations[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! $value instanceof Manipulation) {
            throw new TypeError('Not a Manipulation!');
        }

        $key = $this->findKey($value->method);

        if (is_null($offset) && is_null($key)) {
            $this->manipulations[] = $value;
        } elseif (! is_null($key)) {
            $this->manipulations[$key] = $value;
        } else {
            $this->manipulations[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->manipulations[$offset]);
    }

    /**
     * @return array<int, Manipulation>
     */
    public function all(): array
    {
        return $this->manipulations;
    }

    public function toArray(): array
    {
        $array = [];

        foreach ($this->manipulations as $manipulation) {
            $array[$manipulation->method->value] = $manipulation->parameters;
        }

        return $array;
    }

    public function toCollection(): Collection
    {
        return Collection::make($this->manipulations);
    }
}
