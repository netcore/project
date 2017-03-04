<?php

namespace Netcore\Project\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CleanCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'project:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup the project - delete files, refresh database etc.';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $fs;

    /**
     * RefreshCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->fs = $filesystem;
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        if (!app()->isLocal()) {
            return $this->error('This command can be used only in development environment!');
        }

        $startTime = microtime(true);

        $config = config('netcore.clean-config');

        if ($config['remigrate']) {
            $this->call('migrate:refresh');
        }

        if ($config['seed_database']) {
            $this->call('db:seed');
        }

        if ($config['remove']['logs']) {
            $this->fs->delete(
                storage_path('logs/laravel.log')
            );
        }

        foreach ($config['remove']['files'] as $key => $value) {

            // Delete files in given directory
            if (is_array($value)) {
                foreach ($value as $file) {
                    $this->fs->delete(
                        app_path($key . DIRECTORY_SEPARATOR . $file)
                    );
                }
                continue;
            }

            // Delete entire directory
            if ($this->fs->isDirectory($value)) {
                $this->fs->deleteDirectory($value);
                continue;
            }

            // Delete file
            $this->fs->delete($value);
        }

        // Clear

        if ($config['clear']['cache']) {
            $this->call('cache:clear');
        }

        if ($config['clear']['views']) {
            $this->call('view:clear');
        }

        if ($config['clear']['config']) {
            $this->call('config:clear');
        }

        if ($config['clear']['routes']) {
            $this->call('route:clear');
        }

        $endTime = microtime(true);
        $elapsed = round($endTime - $startTime, 2);

        $this->info('[Project] Cleanup done in ' . $elapsed . ' seconds!');
    }

}
