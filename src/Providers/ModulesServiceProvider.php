<?php

namespace Petryashin\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Petryashin\Modules\Console\Commands\CreateModuleCommand;

final class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerSystemProvider();
            $this->registerCommands();
        }
    }

    private function registerCommands(){
            $this->commands([
                CreateModuleCommand::class,
            ]);
    }

    private function registerSystemProvider()
    {
        $this->app->register(SystemServiceProvider::class);
    }
}
