<?php

namespace Alirezasedghi\LaravelImageFaker\Facades;

use Illuminate\Support\Facades\Facade;


class ImageFaker extends Facade
{
	protected static function getFacadeAccessor() {
		return 'ImageFaker';
	}
}
