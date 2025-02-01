<?php

namespace Yuges\Mediable\Generators\Responsive;

use Yuges\Mediable\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Yuges\Mediable\Generators\Exceptions\InvalidResponsiveGenerator;
use Yuges\Mediable\Generators\Responsive\Calculator\WidthCalculatorFactory;

class ResponsiveGeneratorFactory
{
    public static function create(Media $media): ResponsiveGenerator
    {
        $class = static::getClass($media);

        static::validateGenerator($class);

        /** @var ResponsiveGenerator $responsiveGenerator */
        $responsiveGenerator = new $class;
        $widthCalculator = WidthCalculatorFactory::create($media);

        return $responsiveGenerator
            ->setMedia($media)
            ->setWidthCalculator($widthCalculator);
    }

    protected static function getClass(Media $media): string
    {
        $class = config('mediable.generators.responsive.default');

        foreach (config('mediable.generators.responsive.custom', []) as $modelClass => $customClass) {
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
            throw InvalidResponsiveGenerator::doesntExist($class);
        }

        if (! is_subclass_of($class, ResponsiveGenerator::class)) {
            throw InvalidResponsiveGenerator::doesNotImplementResponsiveGenerator($class);
        }
    }
}
