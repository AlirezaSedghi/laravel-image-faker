<?php

namespace Alirezasedghi\LaravelImageFaker\Services;

use Alirezasedghi\LaravelImageFaker\Base;

class Kittens extends Base
{
    /**
     * Unfortunately, custom filters like grayscale and blur are not currently available.
     */

    /**
     * Service base url
     */
    public string $base_url = 'http://theoldreader.com/kittens';

    /**
     * Make url to get images
     *
     * @param int $width
     * @param int $height
     * @param array $imageOptions
     * @return string
     */
    protected function makeUrl(int $width = 640, int $height = 480, array $imageOptions = []) {
        return sprintf(
            '%s/%s/%s',
            $this->base_url,
            $width,
            $height
        );
    }
}
