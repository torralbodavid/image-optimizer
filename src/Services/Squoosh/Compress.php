<?php

namespace Torralbodavid\ImageOptimizer\Services\Squoosh;

use Illuminate\Support\Facades\File;

class Compress
{
    protected string $format;

    public function __construct(protected string $image)
    {
    }

    public function toJpeg()
    {
        $this->format = 'jpeg';

        return $this->compress('--mozjpeg');
    }

    public function toJpegXl()
    {
        $this->format = 'jxl';

        return $this->compress('--jxl');
    }

    public function toPng()
    {
        $this->format = 'png';

        return $this->compress('--oxipng');
    }

    public function toWebp(): string
    {
        $this->format = 'webp';

        $this->compress(
            '--webp',
            '{"quality":60,"target_size":0,"target_PSNR":0,"method":4,"sns_strength":50,"filter_strength":60,"filter_sharpness":0,"filter_type":1,"partitions":0,"segments":4,"pass":1,"show_compressed":0,"preprocessing":0,"autofilter":0,"partition_limit":0,"alpha_compression":1,"alpha_filtering":1,"alpha_quality":100,"lossless":0,"exact":0,"image_hint":0,"emulate_jpeg_size":0,"thread_level":0,"low_memory":0,"near_lossless":100,"use_delta_palette":0,"use_sharp_yuv":0}'
        );

        return asset(pathinfo($this->image, PATHINFO_FILENAME).'.webp');
    }

    public function toAvif(): string
    {
        $this->format = 'avif';

        $this->compress(
            '--avif',
            '{"cqLevel":33,"cqAlphaLevel":-1,"denoiseLevel":0,"tileColsLog2":0,"tileRowsLog2":0,"speed":10,"subsample":1,"chromaDeltaQ":false,"sharpness":0,"tune":0}'
        );

        return asset(pathinfo($this->image, PATHINFO_FILENAME).'.avif');
    }

    private function compress(string $command, string $configuration = 'auto'): ?int
    {
        if ($this->imageExists($this->format)) {
            return null;
        }

        exec("export PATH=\$PATH:~/bin; squoosh-cli $command '$configuration' $this->image", $output, $code);

        return $code;
    }

    private function imageExists(string $format): bool
    {
        $path = substr($this->image, 0, strrpos($this->image, ".")).".$format";

        return File::exists($path);
    }
}
