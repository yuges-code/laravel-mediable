<?php

namespace Vendor\Template\Exceptions;

use Exception;

class InvalidTemplate extends Exception
{
    public static function doesNotContainInAllowedConfig(string $class): self
    {
        return new static("Template class `{$class}` doesn't contain in allowed templates config");
    }

    public static function doesNotContainInDefaultConfig(string $class): self
    {
        return new static("Template class `{$class}` doesn't contain in default template config");
    }
}
