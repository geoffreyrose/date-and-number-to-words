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
        $this->app->singleton(\DateAndNumberToWords\DateAndNumberToWords::class, function ($app) {
            return new \DateAndNumberToWords\DateAndNumberToWords();
        });

        $this->app->alias(\DateAndNumberToWords\DateAndNumberToWords::class, 'dateandnumbertowords');
    }
}
