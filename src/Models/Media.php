<?php

namespace Yuges\Mediable\Models;

use Illuminate\Database\Eloquent\Model;
use Yuges\Mediable\Observers\MediableObserver;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * @property-read ?\Illuminate\Support\Carbon $created_at
 * @property-read ?\Illuminate\Support\Carbon $updated_at
 */
class Media extends Model
{
    use HasUlids, HasFactory;

    protected $table = 'media';

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::observe(MediableObserver::class);
    }
}
