<?php

namespace Petryashin\Modules\Console\Commands;

use Petryashin\Modules\Generators\DTO\ScenarioDTO;

final class CreateModuleCommand extends BaseCommand
{
    private const MODULE_NAME = "moduleName";
    protected $signature = 'module:create {' . self::MODULE_NAME . "}";

    public function handle()
    {
        $dto = $this->createDTO();

        $this->scenario
            ->setDTO($dto)
            ->execute();
    }

    private function createDTO(): ScenarioDTO
    {
        $dto = new ScenarioDTO();
        $dto->setModuleName($this->argument(self::MODULE_NAME));

        return $dto;
    }


}
