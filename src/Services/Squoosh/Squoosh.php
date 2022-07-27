<?php

namespace Torralbodavid\ImageOptimizer\Services\Squoosh;

use Torralbodavid\ImageOptimizer\Services\Squoosh\Compressor\Compress;

class Squoosh
{
    protected const NPX_COMMAND = 'npx @squoosh/cli';
    protected const COMMAND = 'squoosh-cli';

    public function image(string $image): Compress
    {
        return (new Compress($image));
    }
}
