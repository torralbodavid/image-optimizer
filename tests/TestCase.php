<?php

namespace Torralbodavid\ImageOptimizer\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Torralbodavid\ImageOptimizer\ImageOptimizerServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ImageOptimizerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
