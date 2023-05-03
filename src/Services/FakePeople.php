<?php

namespace Alirezasedghi\LaravelImageFaker\Services;

use Alirezasedghi\LaravelImageFaker\Base;

class FakePeople extends Base
{
    /**
     * Number of 994 static images of fake people from the BoredHumans.com collection
     *
     * Unfortunately, custom sizing options for images are not currently available. All images are set at a fixed size of 512x512 pixels.
     */

    /**
     * Service base url
     */
    public string $base_url = 'https://boredhumans.com/faces2';

    /**
     * SSL verification of service
     */
    public bool $SSL_verify_peer = false;

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
            '%s/%s.jpg',
            $this->base_url,
            mt_rand(1, 994)
        );
    }
}
