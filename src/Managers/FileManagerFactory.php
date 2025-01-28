<?php

namespace Yuges\Mediable\Managers;

use Yuges\Mediable\Manipulations\FileManipulator;

class FileManagerFactory
{
    public static function create(): FileManager
    {
        return new FileManager(new FileManipulator);
    }
}
