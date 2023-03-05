<?php

namespace Petryashin\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Petryashin\Modules\Registrars\RegistrarInterface;

final class RegisterModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this
            ->getRegistrar()
            ->registerModules();
    }

    private function getRegistrar(): RegistrarInterface
    {
        return resolve(RegistrarInterface::class);
    }
}
