<?php

namespace Yuges\Mediable\Managers;

class FileManagerFactory
{
    public static function create(): FileManager
    {
        return new FileManager();
    }
}
