<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Url\UrlGenerator;

class InvalidUrlGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Url generator class {$class} doesn't exist");
    }

    public static function doesNotImplementUrlGenerator(string $class): self
    {
        $urlGeneratorClass = UrlGenerator::class;

        return new static("Url generator Class {$class} must implement `{$urlGeneratorClass}`");
    }
}
