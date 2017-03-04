<?php

namespace Netcore\Project;

use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Netcore\Project\Console\CleanCommand;

class ProjectServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/clean-config.php' => config_path('netcore/clean-config.php'),
            __DIR__ . '/config/loaders.php' => config_path('netcore/loaders.php')
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CleanCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/config/clean-config.php', 'netcore.clean-config');
        $this->mergeConfigFrom(__DIR__ . '/config/loaders.php', 'netcore.loaders');

        // Register dependencies
        if (config('netcore.loaders.debugbar')) {
            $this->app->register(DebugbarServiceProvider::class);
        }

        if (config('netcore.loaders.idehelper')) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

}