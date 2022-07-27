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
        return $this->compress(
            '--webp',
            '{"quality":75,"target_size":0,"target_PSNR":0,"method":4,"sns_strength":50,"filter_strength":60,"filter_sharpness":0,"filter_type":1,"partitions":0,"segments":4,"pass":1,"show_compressed":0,"preprocessing":0,"autofilter":0,"partition_limit":0,"alpha_compression":1,"alpha_filtering":1,"alpha_quality":100,"lossless":0,"exact":0,"image_hint":0,"emulate_jpeg_size":0,"thread_level":0,"low_memory":0,"near_lossless":100,"use_delta_palette":0,"use_sharp_yuv":0}'
        );
    }

    public function toAvif()
    {
        $this->compress(
            '--avif',
            '{"cqLevel":33,"cqAlphaLevel":-1,"denoiseLevel":0,"tileColsLog2":0,"tileRowsLog2":0,"speed":6,"subsample":1,"chromaDeltaQ":false,"sharpness":0,"tune":0}'
        );

        return response()->file(base_path('public/bees.webp'), ['Content-Type' => 'images/webp']);
    }

    private function compress(string $command, string $configuration = 'auto'): int
    {
        exec("export PATH=\$PATH:~/bin; npx @squoosh/cli $command '$configuration' $this->image", $output, $code);

        return $code;
    }
}
