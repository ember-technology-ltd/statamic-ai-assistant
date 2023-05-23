<?php

namespace Jezzdk\StatamicAiAssistant;

use Illuminate\Support\Facades\Route;
use Jezzdk\StatamicAiAssistant\Http\Controllers\OpenAiController;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__ . '/../dist/js/addon.js',
    ];

    protected $stylesheets = [
        __DIR__ . '/../dist/css/addon.css',
    ];

    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css',
        ],
        'publicDirectory' => 'dist',
    ];

    public function bootAddon()
    {
        $this->registerCpRoutes(function () {
            Route::post('/addons/jezzdk/statamic-ai-assistant/{tool}', OpenAiController::class)->name('jezzdk.statamic-ai-assistant');
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
