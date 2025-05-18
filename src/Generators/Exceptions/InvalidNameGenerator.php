<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Name\NameGenerator;

class InvalidNameGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Name generator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementNameGenerator(string $class): self
    {
        $nameGeneratorClass = NameGenerator::class;

        return new static("Name generator class `{$class}` must implement `$nameGeneratorClass}`");
    }
}
