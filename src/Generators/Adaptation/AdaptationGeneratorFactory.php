<?php

namespace Yuges\Mediable\Generators\Adaptation;

use Yuges\Mediable\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Yuges\Mediable\Generators\Exceptions\InvalidAdaptationGenerator;
use Yuges\Mediable\Generators\Adaptation\Calculator\WidthCalculatorFactory;

class AdaptationGeneratorFactory
{
    public static function create(Media $media): AdaptationGenerator
    {
        $class = static::getClass($media);

        static::validateGenerator($class);

        /** @var AdaptationGenerator $adaptationGenerator */
        $adaptationGenerator = new $class;
        $widthCalculator = WidthCalculatorFactory::create($media);

        return $adaptationGenerator
            ->setMedia($media)
            ->setWidthCalculator($widthCalculator);
    }

    protected static function getClass(Media $media): string
    {
        $class = config('mediable.generators.adaptation.default');

        foreach (config('mediable.generators.adaptation.custom', []) as $modelClass => $customClass) {
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
            throw InvalidAdaptationGenerator::doesntExist($class);
        }

        if (! is_subclass_of($class, AdaptationGenerator::class)) {
            throw InvalidAdaptationGenerator::doesNotImplementAdaptationGenerator($class);
        }
    }
}
