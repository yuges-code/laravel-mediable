<?php

namespace Yuges\Mediable\Generators\Url;

class DefaultUrlGenerator extends AbstractUrlGenerator
{
    public function getUrl(): string
    {
        $url = $this->getDisk()->url($this->getPathname());

        return $url;
    }

    public function getPath(): string
    {
        return $this->pathGenerator->getPath($this->media);
    }

    public function getPathname(): string
    {
        return $this->getPath() . $this->media->filename . '.' . $this->media->extension;
    }
}
