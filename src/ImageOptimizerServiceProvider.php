<?php

namespace Torralbodavid\ImageOptimizer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ImageOptimizerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('image-optimizer')
            ->hasConfigFile()
            ->hasViews();
    }
}
