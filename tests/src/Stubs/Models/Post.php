<?php

namespace Yuges\Mediable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = ['id'];
}
