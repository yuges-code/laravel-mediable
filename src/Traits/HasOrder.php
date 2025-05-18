<?php

namespace Yuges\Mediable\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $order
 */
trait HasOrder
{
    public function setHighestOrderNumber(): void
    {
        $column = $this->determineOrderColumnName();

        $this->$column = $this->getHighestOrderNumber() + 1;
    }

    public function getHighestOrderNumber(): int
    {
        return (int) static::where('mediable_type', $this->mediable_type)
            ->where('mediable_id', $this->mediable_id)
            ->max($this->determineOrderColumnName());
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy($this->determineOrderColumnName());
    }

    protected function determineOrderColumnName(): string
    {
        return 'order';
    }

    public function shouldSortWhenCreating(): bool
    {
        return true;
    }
}
