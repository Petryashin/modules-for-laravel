<?php

namespace Petryashin\Modules\Scenarios;

use Petryashin\Modules\Generators\DTO\ScenarioDTO;

interface ScenarioInterface
{
    public function execute(): void;

    public function setDTO(ScenarioDTO $dto): ScenarioInterface;
}
