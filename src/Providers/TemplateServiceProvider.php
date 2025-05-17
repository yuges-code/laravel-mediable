<?php

namespace Vendor\Template\Providers;

use TypeError;
use Yuges\Package\Data\Package;
use Vendor\Template\Config\Config;
use Vendor\Template\Models\Template;
use Vendor\Template\Observers\TemplateObserver;
use Yuges\Package\Providers\PackageServiceProvider;

class TemplateServiceProvider extends PackageServiceProvider
{
    protected string $name = 'laravel-template';

    public function configure(Package $package): void
    {
        $class = Config::getTemplateClass(Template::class);

        if (! is_a($class, Template::class, true)) {
            throw new TypeError('Invalid model');
        }

        $package
            ->hasName($this->name)
            ->hasConfig('template')
            ->hasMigrations([
                'create_template_table',
            ])
            ->hasObserver($class, TemplateObserver::class);
    }
}
