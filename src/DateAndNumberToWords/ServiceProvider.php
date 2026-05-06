<?php

namespace DateAndNumberToWords;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DateAndNumberToWords::class, function ($app) {
            return new DateAndNumberToWords;
        });

        $this->app->alias(DateAndNumberToWords::class, 'dateandnumbertowords');
    }
}
