<?php

namespace Yuges\Mediable\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

/**
 * @property string $id
 * @property-read ?\Illuminate\Support\Carbon $created_at
 * @property-read ?\Illuminate\Support\Carbon $updated_at
 */
class Mediable extends MorphPivot
{
    use HasUlids, HasFactory;

    public $table = 'mediables';

    protected $guarded = ['id'];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
