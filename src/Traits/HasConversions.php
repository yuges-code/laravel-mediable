<?php

namespace Yuges\Mediable\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @property ?array $conversions
 */
trait HasConversions
{
    protected function initializeHasConversions()
    {
        /** @var Model $this */
        $this->mergeCasts(['conversions' => 'array']);
    }

    public function getConversions(): ?array
    {
        return $this->conversions;
    }
}
