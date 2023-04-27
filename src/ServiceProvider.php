<?php

namespace Jezzdk\StatamicAiFields;

use Illuminate\Support\Facades\Route;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__ . '/../dist/js/ai-fields.js',
    ];

    protected $fieldtypes = [
        \Jezzdk\StatamicAiFields\Fieldtypes\ProductDescription::class,
    ];

    public function bootAddon()
    {
        $this->registerCpRoutes(function () {
            Route::post('/addons/jezzdk/statamic-ai-fields/product/description', 'ProductController@description')->name('jezzdk.statamic-ai-fields.product.description');
        });

        $this->publishes([
            __DIR__.'/../config/ai-fields.php' => config_path('ai-fields.php'),
          ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ai-fields.php',
            'ai-fields'
        );
    }
}
