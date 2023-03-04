<?php

namespace Petryashin\Modules\Scenarios;

use Petryashin\Modules\Generators\Commands\Classes\ServiceGeneratorCommand;
use Petryashin\Modules\Generators\Commands\Directories\ActionDirectoryCommand;
use Petryashin\Modules\Generators\Creators\CreatorInterface;
use Petryashin\Modules\Generators\DTO\ScenarioDTO;
use Petryashin\Modules\Generators\Exceptions\CreateDirectoryException;
use Petryashin\Modules\Generators\Exceptions\CreateFileException;

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
        foreach (array_merge(
                     $this->getClassesCommandsForCall(),
                     $this->getDirectoriesCommandsForCall()
                 ) as $command) {
            $command = $this->creator->getGenerator($command);

            try {
                $command->setModuleName($this->dto->getModuleName())->execute();
            } catch (CreateFileException| CreateDirectoryException $systemError) {
                dump($systemError->getMessage());
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

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
    private function getClassesCommandsForCall(): array
    {
        return [
            ServiceGeneratorCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    private function getDirectoriesCommandsForCall(): array
    {
        return [
            ActionDirectoryCommand::class
        ];
    }
}
