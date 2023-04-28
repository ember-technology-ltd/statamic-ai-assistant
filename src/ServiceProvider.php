<?php

namespace Jezzdk\StatamicAiAssistant;

use Illuminate\Support\Facades\Route;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__ . '/../dist/js/ai-assistant.js',
    ];

    // protected $fieldtypes = [
    //     \Jezzdk\StatamicAiAssistant\Fieldtypes\ProductDescription::class,
    // ];

    public function bootAddon()
    {
        $this->registerCpRoutes(function () {
            Route::post('/addons/jezzdk/statamic-ai-assistant/{tool}', 'OpenAiController')->name('jezzdk.statamic-ai-assistant');
        });

        $this->publishes([
            __DIR__.'/../config/ai-assistant.php' => config_path('ai-assistant.php'),
          ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ai-assistant.php',
            'ai-assistant'
        );
    }
}
