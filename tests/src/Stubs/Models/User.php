<?php

namespace Yuges\Mediable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;

class User extends Model
{
    protected $table = 'users';

    protected $guarded = ['id'];
}
