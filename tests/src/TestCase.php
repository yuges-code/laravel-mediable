<?php

namespace Yuges\Mediable\Tests;

use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\Attributes\WithMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Yuges\Mediable\Providers\MediableServiceProvider;

#[WithMigration]
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        # code...

        parent::setUp();
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('mediable', require __DIR__ . '/../../config/mediable.php');
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            MediableServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom([
                __DIR__ . '/../../database/migrations/',
                __DIR__ . '/Stubs/Migrations',
            ]
        );
    }
}
