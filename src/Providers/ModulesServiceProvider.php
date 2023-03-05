<?php

namespace Petryashin\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Petryashin\Modules\Console\Commands\CreateModuleCommand;
use Petryashin\Modules\Registrars\Registrar;
use Petryashin\Modules\Registrars\RegistrarInterface;

final class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->registerSystemProvider();
            $this->registerCommands();
        }

        $this->registerRegistrars();
        $this->app->register(RegisterModulesServiceProvider::class);
    }

    private function registerCommands()
    {
        $this->commands([
            CreateModuleCommand::class,
        ]);
    }

    private function registerSystemProvider()
    {
        $this->app->register(SystemServiceProvider::class);
    }

    /**
     * Register a modules registrar
     */
    private function registerRegistrars()
    {
        $this->app->singleton(RegistrarInterface::class, function (){
            return resolve(Registrar::class, [$this->app]);
        });
    }
}
