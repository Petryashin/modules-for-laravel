<?php

namespace Petryashin\Modules\Scenarios;

use Petryashin\Modules\Generators\Creators\CreatorInterface;
use Petryashin\Modules\Generators\DTO\ScenarioDTO;
use Petryashin\Modules\Generators\ServiceGeneratorCommand;

final class CreateAll implements ScenarioInterface
{
    private ScenarioDTO $dto;

    public function __construct(
        private CreatorInterface $creator
    )
    {
    }

    public function execute(): void
    {
        foreach ($this->getCommandsForCall() as $command) {
            $command = $this->creator->getGenerator($command);

            $command->setModuleName($this->dto->getModuleName())->execute();
        }
    }

    public function setDTO(ScenarioDTO $dto): ScenarioInterface
    {
        $this->dto = $dto;

        return $this;
    }

    /**
     * @return array<string>
     */
    private function getCommandsForCall(): array
    {
        return [
            ServiceGeneratorCommand::class,
        ];
    }
}
