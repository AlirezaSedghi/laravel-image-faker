<?php

namespace Alirezasedghi\LaravelImageFaker\Services;

use Alirezasedghi\LaravelImageFaker\Base;

class LoremFlickr extends Base
{
    /**
     * Service base url
     */
    public string $base_url = 'https://loremflickr.com';

    /**
     * Make url to get images
     *
     * @param int $width
     * @param int $height
     * @param array $imageOptions
     * @return string
     */
    protected function makeUrl(int $width = 640, int $height = 480, array $imageOptions = []) {
        $is_grayscale = $imageOptions["grayscale"] ?? false;
        if ( $is_grayscale )
            unset($imageOptions["grayscale"]);

        return sprintf(
            '%s/%s%s/%s%s%s',
            $this->base_url,
            $is_grayscale ? 'g/' : '',
            $width,
            $height,
            $is_grayscale ? '/random' : '',
            !empty($imageOptions) ? preg_replace('/\b\=1\b/', '', '?' . http_build_query($imageOptions)) : ''
        );
    }
}
