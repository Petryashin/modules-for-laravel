<?php

namespace Petryashin\Modules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Petryashin\Modules\Scenarios\ScenarioInterface;

abstract class BaseCommand extends Command
{
    abstract public function handle();

    public function __construct(
        protected ScenarioInterface $scenario
    )
    {
        parent::__construct();
    }
    protected function getModuleName(): string
    {
        return Str::ucfirst(Str::lower(trim($this->argument('moduleName'))));
    }
}
