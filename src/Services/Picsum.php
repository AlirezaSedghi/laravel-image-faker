<?php

namespace Alirezasedghi\LaravelImageFaker\Services;

use Alirezasedghi\LaravelImageFaker\Base;

class Picsum extends Base
{
    /**
     * Service base url
     */
    public string $base_url = 'https://picsum.photos';

    /**
     * SSL verification of service
     */
    public bool $SSL_verify_peer = false;
}
