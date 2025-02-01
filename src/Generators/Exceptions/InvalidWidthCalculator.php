<?php

namespace Yuges\Mediable\Generators\Exceptions;

use Exception;
use Yuges\Mediable\Generators\Responsive\Calculator\WidthCalculator;

class InvalidWidthCalculator extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Width calculator class `{$class}` doesn't exist");
    }

    public static function doesNotImplementWidthCalculator(string $class): self
    {
        $widthCalculatorClass = WidthCalculator::class;

        return new static("Width calculator class `{$class}` must implement `$widthCalculatorClass}`");
    }
}
