<?php

namespace Yuges\Mediable\Tests\Feature;

use Yuges\Mediable\Tests\TestCase;
use Yuges\Mediable\Tests\Stubs\Models\User;
use Yuges\Mediable\Tests\Stubs\Models\Post;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
        $this->assertEquals('posts', Post::getTableName());
    }
}
