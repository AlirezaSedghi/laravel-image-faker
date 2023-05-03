<?php

namespace Alirezasedghi\LaravelImageFaker;

use Illuminate\Support\ServiceProvider;

class ImageFakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->alias(ImageFaker::class, 'ImageFaker');

        $this->app->bind('ImageFaker', function ($app) { // Base $service
            return new ImageFaker($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {

    }
}
