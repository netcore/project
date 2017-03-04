<?php

namespace Netcore\Project;

use Illuminate\Support\ServiceProvider;
use Netcore\Project\Commands\CleanCommand;

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
            __DIR__ . '/config/clean-config.php' => config_path('netcore/clean-config.php')
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
        $this->mergeConfigFrom(
            __DIR__ . '/config/clean-config.php', 'netcore.clean-config'
        );
    }

}