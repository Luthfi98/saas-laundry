<?php

namespace App\Providers;

use App\Helpers\GeneralHelper;
use Illuminate\Support\ServiceProvider;

class GeneralHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('generalhelper', function () {
            return new GeneralHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
