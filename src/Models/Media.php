<?php

namespace Yuges\Mediable\Models;

use Yuges\Package\Models\Model;
use Yuges\Mediable\Config\Config;
use Yuges\Mediable\Traits\HasUrl;
use Yuges\Mediable\Traits\HasPath;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Mediable\Traits\HasMediable;
use Illuminate\Support\Facades\Storage;
use Yuges\Mediable\Traits\HasResponsive;
use Yuges\Mediable\Traits\HasPlaceholder;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
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
class Media extends Model implements Orderable
{
    use
        HasUrl,
        HasPath,
        HasOrder,
        HasFactory,
        HasMediable,
        HasResponsive,
        HasPlaceholder;

    protected $table = 'media';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getMediaTable() ?? $this->table;
    }

    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'conversions' => 'array',
            'manipulations' => 'array',
            'temporary' => 'boolean',
        ];
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where('mediable_id', $this->mediable_id)
            ->where('mediable_type', $this->mediable_type);

        return $options;
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
