<?php

namespace Yuges\Mediable\Managers;

use Yuges\Mediable\Interfaces\Mediable;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerFactory
{
    public static function create(Mediable $model, string|UploadedFile $file): FileManager
    {
        $manager = new FileManager();

        return $manager
            ->setFile($file)
            ->setModel($model);
    }
}
