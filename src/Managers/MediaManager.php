<?php

namespace Yuges\Mediable\Managers;

use Exception;
use Yuges\Mediable\Models\Media;
use Yuges\Mediable\Config\Config;
use Yuges\Mediable\Traits\HasOptions;
use Yuges\Mediable\Interfaces\Mediable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaManager
{
    use HasOptions;

    protected ?Mediable $model = null;

    protected UploadedFile|File|null $file = null;

    public function __construct(
        protected FileManager $fileManager
    ) {
    }

    public function setModel(Mediable $model): self
    {
        $this->model = $model;

        return $this;
    }

    public static function createMedia(): Media
    {
        $class = Config::getMediaClass();

        return new $class;
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

    public function store(?string $collection = null, ?string $disk = null): Media
    {
        $this
            ->setDisk($disk ?? $this->disk)
            ->setCollection($collection ?? $this->collection);

        if (! $this->file) {
            throw new Exception('File does not exist');
        }

        $media = $this->createMedia();

        return $this
            ->fillMedia($media)
            ->attachMedia($media);
    }

    protected function fillMedia(Media $media): self
    {
        $media
            ->updateTimestamps()
            ->setUniqueIds();

        $media->disk = $this->disk ?: config('mediable.disk');
        $media->collection = $this->collection ?: 'default';
        $media->temporary = $this->temporary;
        $media->properties = $this->properties;
        $media->manipulations = $this->manipulations;

        $media->setFile($this->file);

        return $this;
    }

    protected function attachMedia(Media $media): Media
    {
        if (! $this->model->exists) {
            /**
             * @todo not exists
             */

            return $media;
        }

        return $this->process($media, $this->model);
    }

    protected function process(Media $media, Mediable $model): Media
    {
        $model->attachMedia($media);

        $this->fileManager
            ->store($this->file, $media)
            ->preserve($this->file, $this->preserveSource);

        return $media;
    }
}
