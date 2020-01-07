<?php

namespace ConfrariaWeb\Vendor\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'import');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

}
