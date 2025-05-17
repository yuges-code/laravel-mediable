<?php

namespace Yuges\Package\Tests\Feature;

use Yuges\Package\Tests\TestCase;
use Yuges\Package\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
