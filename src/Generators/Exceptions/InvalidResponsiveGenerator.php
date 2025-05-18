<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Responsive\ResponsiveGenerator;

class InvalidResponsiveGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Responsive generator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementResponsiveGenerator(string $class): self
    {
        $responsiveGeneratorClass = ResponsiveGenerator::class;

        return new static("Responsive generator class `{$class}` must implement `$responsiveGeneratorClass}`");
    }
}
