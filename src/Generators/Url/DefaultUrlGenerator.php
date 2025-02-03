<?php

namespace Yuges\Mediable\Generators\Url;

use Yuges\Mediable\Conversions\MediaConversion;

class DefaultUrlGenerator extends AbstractUrlGenerator
{
    public function getUrl(string $conversion = ''): string
    {
        if ($conversion) {
            $conversion = MediaConversion::create($conversion);

            $url = $this->getDisk()->url($conversion->getPathname($this->media));
        } else {
            $url = $this->getDisk()->url($this->getPathname());
        }

        return $url;
    }

    public function getFilename(): string
    {
        return $this->media->filename . '.' . $this->media->extension;
    }

    public function getPath(): string
    {
        return $this->pathGenerator->getPath($this->media);
    }

    public function getPathname(): string
    {
        return $this->getPath() . $this->getFilename();
    }
}
