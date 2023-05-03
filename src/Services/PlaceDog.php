<?php

namespace Alirezasedghi\LaravelImageFaker\Services;

use Alirezasedghi\LaravelImageFaker\Base;

class PlaceDog extends Base
{
    /**
     * Service base url
     */
    public string $base_url = 'https://placedog.net';

    /**
     * Make url to get images
     *
     * @param int $width
     * @param int $height
     * @param array $imageOptions
     * @return string
     */
    protected function makeUrl(int $width = 640, int $height = 480, array $imageOptions = []) {
        $imageOptions["random"] = true;

        $is_grayscale = $imageOptions["grayscale"] ?? false;
        if ( $is_grayscale )
            unset($imageOptions["grayscale"]);

        $is_blur = $is_grayscale ? false : ($imageOptions["blur"] ?? false);
        if ( $is_blur )
            unset($imageOptions["blur"]);

        return sprintf(
            '%s/%s/%s%s%s%s',
            $this->base_url,
            $width,
            $height,
            $is_grayscale ? '/g' : '',
            $is_blur ? '/b' : '',
            !empty($imageOptions) ? preg_replace('/\b\=1\b/', '', '?' . http_build_query($imageOptions)) : ''
        );
    }
}
