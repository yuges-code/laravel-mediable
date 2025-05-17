<?php

namespace Yuges\Mediable\Models;

use Yuges\Package\Models\Model;
use Yuges\Mediable\Traits\HasUrl;
use Yuges\Mediable\Traits\HasPath;
use Yuges\Mediable\Traits\HasOrder;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Traits\HasResponsive;
use Yuges\Mediable\Traits\HasPlaceholder;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @property string $mediable_id
 * @property string $mediable_type
 * @property string $collection
 * @property string $disk
 * @property string $directory
 * @property string $filename
 * @property string $extension
 * @property string $mime
 * @property integer $size
 * @property boolean $temporary
 * @property ?array $manipulations
 * @property ?array $conversions
 * @property ?array $properties
 */
class Media extends Model
{
    use
        HasUrl,
        HasPath,
        HasOrder,
        HasFactory,
        HasResponsive,
        HasPlaceholder;

    protected $table = 'media';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'responsive' => 'array',
            'properties' => 'array',
            'conversions' => 'array',
            'placeholders' => 'array',
            'manipulations' => 'array',
            'temporary' => 'boolean',
        ];
    }

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function setFile(UploadedFile|File $file)
    {
        $filename = $file->getFilename();

        if ($file instanceof UploadedFile) {
            $filename = $file->getClientOriginalName();
        }

        $this->directory = $this->getPath();
        $this->filename = pathinfo($filename, PATHINFO_FILENAME);
        $this->extension = $file->guessExtension();
        $this->mime = $file->getMimeType();
        $this->size = $file->getSize();
    }

    public function getFile(?string $conversion = null): File
    {
        $path = Storage::disk($this->disk)->path($this->getPathname($conversion));

        return new File($path);
    }
}
