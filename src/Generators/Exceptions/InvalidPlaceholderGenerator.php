<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Placeholder\PlaceholderGenerator;

class InvalidPlaceholderGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Placeholder generator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementPlaceholderGenerator(string $class): self
    {
        $placeholderGeneratorClass = PlaceholderGenerator::class;

        return new static("Placeholder generator class `{$class}` must implement `$placeholderGeneratorClass}`");
    }
}
