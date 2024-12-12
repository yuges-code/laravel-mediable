<?php

namespace Yuges\Mediable\Generators\Url;

use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Generators\Path\PathGeneratorFactory;
use Yuges\Mediable\Generators\Exceptions\InvalidUrlGenerator;

class UrlGeneratorFactory
{
    public static function create(Media $media): UrlGenerator
    {
        $urlGeneratorClass = static::getUrlGeneratorClass($media);

        static::validateUrlGenerator($urlGeneratorClass);

        /** @var UrlGenerator $urlGenerator */
        $urlGenerator = new $urlGeneratorClass;
        $pathGenerator = PathGeneratorFactory::create($media);

        $urlGenerator
            ->setMedia($media)
            ->setPathGenerator($pathGenerator);

        return $urlGenerator;
    }

    protected static function getUrlGeneratorClass(Media $media): string
    {
        $defaultUrlGeneratorClass = config('mediable.generators.url.default');

        return $defaultUrlGeneratorClass;
    }

    public static function validateUrlGenerator(string $urlGeneratorClass): void
    {
        if (! class_exists($urlGeneratorClass)) {
            throw InvalidUrlGenerator::doesntExist($urlGeneratorClass);
        }

        if (! is_subclass_of($urlGeneratorClass, UrlGenerator::class)) {
            throw InvalidUrlGenerator::doesNotImplementUrlGenerator($urlGeneratorClass);
        }
    }
}