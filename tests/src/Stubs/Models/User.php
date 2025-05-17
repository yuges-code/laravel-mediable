<?php

namespace Yuges\Package\Tests\Stubs\Models;

use Yuges\Package\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasTable;

    protected $table = 'users';
}
