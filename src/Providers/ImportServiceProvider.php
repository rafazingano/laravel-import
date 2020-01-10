<?php

namespace ConfrariaWeb\Import\Providers;

use ConfrariaWeb\Import\Contracts\ImportContract;
use ConfrariaWeb\Import\Contracts\ImportTypeContract;
use ConfrariaWeb\Import\Repositories\ImportRepository;
use ConfrariaWeb\Import\Repositories\ImportTypeRepository;
use ConfrariaWeb\Import\Services\ImportService;
use ConfrariaWeb\Import\Services\ImportTypeService;
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
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations', 'import');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'import');
        $this->publishes([__DIR__ . '/../../config/cw_import.php' => config_path('cw_import.php')], 'cw_import');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(ImportTypeContract::class, ImportTypeRepository::class);
        $this->app->bind('ImportTypeService', function ($app) {
            return new ImportTypeService($app->make(ImportTypeContract::class));
        });

        $this->app->bind(ImportContract::class, ImportRepository::class);
        $this->app->bind('ImportService', function ($app) {
            return new ImportService($app->make(ImportContract::class));
        });

    }

}
