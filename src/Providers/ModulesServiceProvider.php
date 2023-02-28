<?php

namespace Petryashin\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Petryashin\Modules\Console\Commands\CreateModuleCommand;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    private function registerCommands(){
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateModuleCommand::class,
            ]);
        }
    }
}
