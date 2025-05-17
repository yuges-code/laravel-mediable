<?php

namespace Vendor\Template\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
class Template extends Model
{
    use
        HasUlids,
        HasFactory;

    protected $table = 'templates';

    protected $guarded = ['id'];
}
