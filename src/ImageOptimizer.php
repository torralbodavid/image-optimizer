<?php

namespace Torralbodavid\ImageOptimizer;

use Torralbodavid\ImageOptimizer\Services\Squoosh\Compress;

class ImageOptimizer
{
    public function image(string $image): Compress
    {
        return new Compress($image);
    }
}
