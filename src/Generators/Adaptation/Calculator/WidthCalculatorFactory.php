<?php

namespace Yuges\Mediable\Generators\Adaptation\Calculator;

use Yuges\Mediable\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Yuges\Mediable\Generators\Exceptions\InvalidWidthCalculator;

class WidthCalculatorFactory
{
    public static function create(Media $media): WidthCalculator
    {
        $class = static::getClass($media);

        static::validateGenerator($class);

        /** @var WidthCalculator $widthCalculator */
        $widthCalculator = new $class;

        return $widthCalculator->setMedia($media);
    }

    protected static function getClass(Media $media): string
    {
        $class = config('mediable.generators.responsive.calculator.default');

        foreach (config('mediable.generators.responsive.calculator.custom', []) as $modelClass => $customClass) {
            if (static::mediaBelongToModelClass($media, $modelClass)) {
                return $customClass;
            }
        }

        return $class;
    }

    protected static function mediaBelongToModelClass(Media $media, string $class): bool
    {
        if (is_a($media->mediable_type, $class, true)) {
            return true;
        }

        if ($media->mediable_type === $class) {
            return true;
        }

        if (is_a((string) Relation::getMorphedModel($media->mediable_type), $class, true)) {
            return true;
        }

        return false;
    }

    protected static function validateGenerator(string $class): void
    {
        if (! class_exists($class)) {
            throw InvalidWidthCalculator::doesntExist($class);
        }

        if (! is_subclass_of($class, WidthCalculator::class)) {
            throw InvalidWidthCalculator::doesNotImplementWidthCalculator($class);
        }
    }
}
