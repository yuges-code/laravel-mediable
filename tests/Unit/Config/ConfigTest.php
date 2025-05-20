<?php

namespace Yuges\Mediable\Tests\Unit\Config;

use Illuminate\Support\Str;
use Yuges\Mediable\Config\Config;
use Yuges\Mediable\Tests\TestCase;

class ConfigTest extends TestCase
{
    protected int $length = 10;

    public function testConfigFunctionExists()
    {
        $this->assertTrue(function_exists('config'));
    }

    public function testGetMediaTable(): void
    {
        $expected = Str::random($this->length);

        config()->set('mediable.models.media.table', $expected);

        $actual = Config::getMediaTable();

        $this->assertEquals($expected, $actual);
    }

    public function testGetMediaClass(): void
    {
        $expected = Str::random($this->length);

        config()->set('mediable.models.media.class', $expected);

        $actual = Config::getMediaClass();

        $this->assertEquals($expected, $actual);
    }
}
