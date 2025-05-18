<?php

namespace Yuges\Mediable\Traits;

/**
 * @property ?array $placeholders
 */
trait HasPlaceholder
{
    public function getPlaceholders(): ?array
    {
        return $this->placeholders;
    }

    public function getPlaceholder(string $conversion = 'original'): ?string
    {
        return $this->placeholders[$conversion] ?? null;
    }
}
