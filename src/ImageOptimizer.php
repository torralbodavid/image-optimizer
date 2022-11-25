<?php

namespace Torralbodavid\ImageOptimizer;

use Torralbodavid\ImageOptimizer\Services\Squoosh\Compress;

class ImageOptimizer
{
    public function image(string $image, ?string $width = null, ?string $height = null): Compress
    {
        return new Compress($image, $width, $height);
    }
}
