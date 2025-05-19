<?php

namespace Yuges\Mediable\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @property ?array $placeholders
 */
trait HasPlaceholder
{
    protected function initializeHasPlaceholder()
    {
        /** @var Model $this */
        $this->mergeCasts(['placeholders' => 'array']);
    }

    public function getPlaceholders(): ?array
    {
        return $this->placeholders;
    }

    public function getPlaceholder(string $conversion = 'original'): ?string
    {
        return $this->placeholders[$conversion] ?? null;
    }
}
