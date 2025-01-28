<?php

namespace Yuges\Mediable\Generators\Conversion;

use Yuges\Mediable\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;
use Yuges\Mediable\Generators\Exceptions\InvalidConversionGenerator;

class ConversionGeneratorFactory
{
    public static function create(Media $media): ConversionGenerator
    {
        $class = static::getClass($media);

        static::validateGenerator($class);

        /** @var ConversionGenerator $conversionGenerator */
        $conversionGenerator = new $class;
        $pathGenerator = PathGeneratorFactory::create($media);

        $conversionGenerator
            ->setMedia($media)
            ->setPathGenerator($pathGenerator);

        return $conversionGenerator;
    }

    protected static function getClass(Media $media): string
    {
        $class = config('mediable.generators.conversion.default');

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
            throw InvalidConversionGenerator::doesntExist($class);
        }

        if (! is_subclass_of($class, ConversionGenerator::class)) {
            throw InvalidConversionGenerator::doesNotImplementConversionGenerator($class);
        }
    }
}
