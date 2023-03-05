<?php

namespace Petryashin\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Petryashin\Modules\Console\Commands\CreateModuleCommand;
use Petryashin\Modules\Generators\Creators\Creator;
use Petryashin\Modules\Generators\Creators\CreatorInterface;
use Petryashin\Modules\Generators\Readers\Reader;
use Petryashin\Modules\Generators\Readers\ReaderInterface;
use Petryashin\Modules\Generators\Writers\Writer;
use Petryashin\Modules\Generators\Writers\WriterInterface;
use Petryashin\Modules\Scenarios\CreateAll;
use Petryashin\Modules\Scenarios\ScenarioInterface;

final class SystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function register()
    {
        $this->resolveImplementations();
    }

    private function resolveImplementations()
    {
        $this->app->singleton(ReaderInterface::class, Reader::class);
        $this->app->singleton(WriterInterface::class, Writer::class);

        $this->app->bind(CreatorInterface::class, Creator::class);

        $this->app->when(CreateModuleCommand::class)
            ->needs(ScenarioInterface::class)
            ->give(CreateAll::class);

    }
}
