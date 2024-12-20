<?php

namespace Yuges\Mediable\Models;

use Yuges\Mediable\Traits\HasUrl;
use Yuges\Mediable\Traits\HasPath;
use Illuminate\Database\Eloquent\Model;
use Yuges\Mediable\Observers\MediableObserver;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @property string $id
 * @property string $disk
 * @property string $directory
 * @property string $filename
 * @property string $extension
 * @property string $mime
 * @property integer $size
 * @property array $manipulations
 * @property array $properties
 * 
 * @property-read ?\Illuminate\Support\Carbon $created_at
 * @property-read ?\Illuminate\Support\Carbon $updated_at
 */
class Media extends Model
{
    use HasUlids, HasFactory, HasPath, HasUrl;

    protected $table = 'media';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'manipulations' => 'array',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::observe(MediableObserver::class);
    }

    public function setFile(UploadedFile|File $file, string $disk = null)
    {
        $this->updateTimestamps()->setUniqueIds();

        $this->disk = $disk ?: config('mediable.disk');
        $this->directory = $this->getPath();
        $this->filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
        $this->extension = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
        $this->mime = $file->getMimeType();
        $this->size = $file->getSize();
    }
}
