<?php

namespace Yuges\Mediable\Managers;

use Exception;
use Yuges\Mediable\Models\Media;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Interfaces\Mediable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    protected ?Mediable $model = null;

    protected UploadedFile|File|null $file = null;

    public function setModel(Mediable $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setFile(string|UploadedFile $file): self
    {
        if (is_string($file)) {
            $this->file = new File($file);
        } else {
            $this->file = $file;
        }

        return $this;
    }

    public function store(string $disk = null): Media
    {
        $media = new Media();

        if (!$this->file) {
            throw new Exception('qqqqqqqqqqqqq');
        }

        $media->setFile($this->file);

        $media->manipulations;
        $media->properties;

        Storage::disk($media->disk)->put(
            $media->getPathname(),
            $this->file
        );

        $media->save();
        

        return $media;
    }
}
