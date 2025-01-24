<?php

namespace Yuges\Mediable\Managers;

use Yuges\Mediable\Interfaces\Mediable;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaManagerFactory
{
    public static function create(Mediable $model, string|UploadedFile $file): MediaManager
    {
        $manager = new MediaManager(
            FileManagerFactory::create()
        );

        return $manager
            ->setFile($file)
            ->setModel($model);
    }
}
