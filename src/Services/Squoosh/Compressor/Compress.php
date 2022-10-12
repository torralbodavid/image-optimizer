<?php

namespace Torralbodavid\ImageOptimizer\Services\Squoosh\Compressor;

class Compress
{
    public function __construct(protected string $image)
    {
    }

    public function original()
    {
    }

    public function toJpeg()
    {
        return $this->compress('--mozjpeg');
    }

    public function toJpegXl()
    {
        return $this->compress('--jxl');
    }

    public function toPng()
    {
        return $this->compress('--oxipng');
    }

    public function toWebp()
    {
        $this->compress(
            '--webp',
            '{quality: 100, lossless: 1}'
        );

        return asset(pathinfo($this->image, PATHINFO_FILENAME).'.webp');
    }

    public function toAvif()
    {
        $this->compress(
            '--avif',
            '{"cqLevel":33,"cqAlphaLevel":-1,"denoiseLevel":0,"tileColsLog2":0,"tileRowsLog2":0,"speed":6,"subsample":1,"chromaDeltaQ":false,"sharpness":0,"tune":0}'
        );

        return asset(pathinfo($this->image, PATHINFO_FILENAME).'.avif');
    }

    private function compress(string $command, string $configuration = 'auto'): int
    {
        exec("export PATH=\$PATH:~/bin; npx @squoosh/cli $command '$configuration' $this->image", $output, $code);

        return $code;
    }
}
