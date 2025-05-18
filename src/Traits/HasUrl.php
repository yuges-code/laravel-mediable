<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Generators\Url\UrlGenerator;
use Yuges\Mediable\Generators\Url\UrlGeneratorFactory;

trait HasUrl
{
    public function getUrl(string $conversion = ''): string
    {
        $generator = $this->getUrlGenerator();

        return $generator->getUrl($conversion);
    }

    public function getUrlGenerator(): UrlGenerator
    {
        return UrlGeneratorFactory::create($this);
    }
}
