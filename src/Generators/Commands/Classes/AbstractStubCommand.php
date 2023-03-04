<?php

namespace Petryashin\Modules\Generators\Commands\Classes;

use Illuminate\Support\Str;
use Petryashin\Modules\Generators\Commands\Directories\AbstractDirectoryCommand;
use Petryashin\Modules\Generators\Exceptions\CreateFileException;

abstract class AbstractStubCommand extends AbstractDirectoryCommand
{

    protected ?string $moduleName;

    abstract protected function getParamsForReplacement(): array;

    abstract protected function getModuleType(): string;

    final public function execute(): void
    {
        parent::execute();

        $filePath = $this->getCreatedFilePath();

        if ($this->checkFileExists($filePath)) {
            throw new CreateFileException(
                sprintf('%s Modules/%s/%s', CreateFileException::FILE_ALREADY_EXISTS,
                    $this->getModuleName(),
                    $this->getModuleType())
            );
        }

        $this->createClass($filePath);
    }

    private function createClass(string $filePath)
    {
        $content = $this->getStubContent();

        $this->replaceAllPatterns($content);

        $isSuccess = $this->writeNewClass($filePath, $content);

        if (!$isSuccess) {
            throw new CreateFileException(CreateFileException::MESSAGE . $this->getModuleName());
        }
    }

    private function checkFileExists(string $path): bool
    {
        return $this->writer->exists($path);
    }

    private function writeNewClass(string $path, string $content): bool
    {
        return $this->writer->write($path, $content);
    }

    private function replaceAllPatterns(string &$content)
    {
        foreach ($this->getParamsForReplacement() as $patternName => $replacement) {
            $this->replacePattern($content, $patternName, $replacement);
        }
    }

    private function replacePattern(string &$content, string $patternName, string $replacement): void
    {
        $content = str_replace("{{ $patternName }}", $replacement, $content);
    }

    private function getStubContent(): string
    {
        return $this->reader->read($this->getStubContentPath());
    }
}
