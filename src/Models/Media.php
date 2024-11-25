<?php

namespace Yuges\Mediable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property-read ?\Illuminate\Support\Carbon $created_at
 * @property-read ?\Illuminate\Support\Carbon $updated_at
 */
class Media extends Model
{
    protected $table = 'media';

    protected $guarded = ['id'];
}
