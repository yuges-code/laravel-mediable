<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Conversion\ConversionGenerator;

class InvalidConversionGenerator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Conversion generator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementConversionGenerator(string $class): self
    {
        $conversionGeneratorClass = ConversionGenerator::class;

        return new static("Conversion generator class `{$class}` must implement `$conversionGeneratorClass}`");
    }
}
