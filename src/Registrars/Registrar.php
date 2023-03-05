<?php

namespace Petryashin\Modules\Registrars;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

final class Registrar implements RegistrarInterface
{
    private string $directoryPath;
    private bool $directoryExist;

    public function __construct(
        private Application $app
    )
    {
        $this->directoryPath = base_path('modules');
        $this->checkDirectory();
    }

    public function registerModules(): void
    {
        if (!$this->directoryExists()) {
            return;
        }

        $this->getServiceProviders()->each(
            function ($className) {
                $this->app->register($className);
            }
        );
    }

    /**
     * @return Collection<string>
     */
    private function getServiceProviders(): Collection
    {
        // TODO: Refactoring (I'm tired today.)
        return collect(File::directories($this->directoryPath))
            ->map(function ($path) {
                $moduleName = (string)Str::of($path)
                    ->afterLast('/')
                    ->ucfirst();

                return (string)Str::of("Modules")
                    ->append(
                        '\\',
                        $moduleName,
                        '\\',
                        "ServiceProviders",
                        '\\',
                        $moduleName . "ServiceProvider");
            });
    }

    private function checkDirectory(): void
    {
        $this->directoryExist = File::isDirectory($this->directoryPath);
    }

    private function directoryExists(): bool
    {
        return $this->directoryExist;
    }
}
