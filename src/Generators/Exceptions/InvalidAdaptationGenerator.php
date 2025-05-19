<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Adaptation\AdaptationGenerator;

class InvalidAdaptationGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Adaptation generator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementAdaptationGenerator(string $class): self
    {
        $adaptationGeneratorClass = AdaptationGenerator::class;

        return new static("Adaptation generator class `{$class}` must implement `$adaptationGeneratorClass}`");
    }
}
