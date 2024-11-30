<?php

namespace Yuges\Mediable\Managers;

use Yuges\Mediable\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerFactory
{
    public static function create(Media $model, string|UploadedFile $file): FileManager
    {
        $manager = new FileManager();

        return $manager;
    }
}
