<?php

namespace Petryashin\Modules\Console\Commands;

use Petryashin\Modules\Console\Commands\Generators\ServiceGeneratorCommand;

class CreateModuleCommand extends BaseCommand
{
    protected $signature = 'module:create {moduleName}';

    public function handle()
    {
        foreach ($this->getCommandsForCall() as $command) {
            $this->call($command, ["moduleName" => $this->argument('moduleName')]);
        }
    }

    /**
     * @return array<string>
     */
    private function getCommandsForCall(): array
    {
        return [
            ServiceGeneratorCommand::class
        ];
    }
}
