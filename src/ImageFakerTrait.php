<?php

namespace Alirezasedghi\LaravelImageFaker;

trait ImageFakerTrait
{
    /**
     * Generate the URL that will return a random image
     *
     * @param int $width
     * @param int $height
     * @param bool $grayscale
     * @param bool $blur
     * @return string
     */
    public function imageUrl(int $width = 640, int $height = 480, bool $grayscale = false, bool|int $blur = false): string
    {
        return $this->service->imageUrl($width, $height, $grayscale, $blur);
    }

    /**
     * Download a remote random image to disk and return its location
     *
     * @return bool|string
     */
    public function image(string $dir = null, int $width = 640, int $height = 480, bool $fullPath = true, bool $grayscale = false, bool|int $blur = false) {
        return $this->service->image($dir, $width, $height, $fullPath, $grayscale, $blur);
    }
}
