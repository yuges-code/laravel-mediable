<?php

namespace Yuges\Mediable\Generators\Url;

class DefaultUrlGenerator extends AbstractUrlGenerator
{
    public function getUrl(): string
    {
        $url = $this->getDisk()->url($this->getPath());

        return $url;
    }

    public function getPath(): string
    {
        return $this->pathGenerator->getPath($this->media);
    }
}
