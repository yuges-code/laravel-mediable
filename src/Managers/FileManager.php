<?php

namespace Yuges\Mediable\Managers;

use Yuges\Mediable\Models\Media;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Yuges\Mediable\Manipulations\FileManipulator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    public function __construct(
        protected FileManipulator $manipulator
    ) {
    }

    public function store(UploadedFile|File|string $file, Media $media): self
    {
        return $this
            ->copy($file, $media)
            ->generateDerivedFiles($media);
    }

    public function copy(UploadedFile|File|string $file, Media $media): self
    {
        $file = fopen($file->getPathname(), 'r');

        Storage::disk($media->disk)->put(
            $media->getPathname(),
            $file,
        );

        if (is_resource($file)) {
            fclose($file);
        }

        return $this;
    }

    public function preserve(UploadedFile|File|string $file, bool $preserve = true): self
    {
        if ($preserve) {
            return $this;
        }

        return $this->remove($file);
    }

    public function remove(UploadedFile|File|string $file): self
    {
        if (file_exists($file)) {
            unlink($file);
        }

        return $this;
    }

    public function removeAll(Media $media): self
    {
        Storage::disk($media->disk)->deleteDirectory($media->getPath());

        return $this;
    }

    public function generateDerivedFiles(Media $media): self
    {
        $this->manipulator->generateDerivedFiles($media);

        return $this;
    }
}
