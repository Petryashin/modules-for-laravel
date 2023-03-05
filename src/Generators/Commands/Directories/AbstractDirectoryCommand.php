<?php

namespace Petryashin\Modules\Generators\Commands\Directories;

use Petryashin\Modules\Generators\Exceptions\CreateDirectoryException;

abstract class AbstractDirectoryCommand extends \Petryashin\Modules\Generators\Commands\AbstractCommand
{
    public function execute(): void
    {
        $this->createDirectory();
    }

    private function createDirectory(){
        $directoryPath = $this->getCreatedDirectoryPath();

        $isSuccess = $this->writeDirectory($directoryPath);

        if (!$isSuccess) {
            throw new CreateDirectoryException(CreateDirectoryException::MESSAGE . $this->getModuleName());
        }
    }
    private function writeDirectory(string $path): bool
    {
        return $this->writer->createDirectory($path);
    }
}
