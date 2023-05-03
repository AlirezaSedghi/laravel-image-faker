<?php

namespace Alirezasedghi\LaravelImageFaker;

use Illuminate\Support\Str;

class ImageFaker
{
    use ImageFakerTrait;

    /**
     * Service
     *
     * @var Base
     */
    protected Base $service;

    /**
     * Construction
     *
     * @param Base $service
     */
    public function __construct(Base $service)
    {
        $this->service = $service;
    }
}
