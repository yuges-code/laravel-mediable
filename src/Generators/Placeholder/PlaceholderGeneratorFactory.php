<?php

namespace Yuges\Mediable\Generators\Placeholder;

use Yuges\Mediable\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Yuges\Mediable\Generators\Exceptions\InvalidPlaceholderGenerator;

class PlaceholderGeneratorFactory
{
    public static function create(Media $media): PlaceholderGenerator
    {
        $class = static::getClass($media);

        static::validateGenerator($class);

        return new $class;
    }

    protected static function getClass(Media $media): string
    {
        $class = config('mediable.generators.placeholder.default');

        // foreach (config('media-library.custom_path_generators', []) as $modelClass => $customPathGeneratorClass) {
        //     if (static::mediaBelongToModelClass($media, $modelClass)) {
        //         return $customPathGeneratorClass;
        //     }
        // }

        return $class;
    }

    protected static function mediaBelongToModelClass(Media $media, string $modelClass): bool
    {
        // model doesn't have morphMap, so morph type and class are equal
        if (is_a($media->model_type, $modelClass, true)) {
            return true;
        }
        // config is set via morphMap alias
        if ($media->model_type === $modelClass) {
            return true;
        }
        // config is set via morphMap class name
        if (is_a((string) Relation::getMorphedModel($media->model_type), $modelClass, true)) {
            return true;
        }

        return false;
    }

    protected static function validateGenerator(string $class): void
    {
        if (! class_exists($class)) {
            throw InvalidPlaceholderGenerator::doesntExist($class);
        }

        if (! is_subclass_of($class, PlaceholderGenerator::class)) {
            throw InvalidPlaceholderGenerator::doesNotImplementPlaceholderGenerator($class);
        }
    }
}
