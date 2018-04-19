<?php

namespace App\Providers;


use App\Services\CarImport;
use Illuminate\Support\ServiceProvider;

class CarImportServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('carImport', function ($app) {
            return new CarImport();
        });
    }

    public function provides()
    {
        return [CarImport::class];
    }
}
