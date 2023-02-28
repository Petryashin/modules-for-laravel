<?php

namespace Petryashin\Modules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

abstract class BaseCommand extends Command
{
    abstract public function handle();

    protected function getModulName(): string
    {
        return Str::ucfirst(Str::lower(trim($this->argument('moduleName'))));
    }

    protected function getArguments()
    {
        return [
            ['moduleName', InputArgument::REQUIRED, 'A base module name']
        ];
    }
}
