<?php

namespace Yuges\Mediable\Traits;

use Yuges\Mediable\Generators\Url\UrlGenerator;
use Yuges\Mediable\Generators\Url\UrlGeneratorFactory;

trait HasUrl
{
    public function getUrl(): string
    {
        $generator = $this->getUrlGenerator();

        return $generator->getUrl($this);
    }

    public function getUrlGenerator(): UrlGenerator
    {
        return UrlGeneratorFactory::create($this);
    }
}
