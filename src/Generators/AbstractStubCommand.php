<?php

namespace Petryashin\Modules\Generators;

use Petryashin\Modules\Generators\Exceptions\CreateDirectoryException;
use Petryashin\Modules\Generators\Exceptions\CreateFileException;
use Petryashin\Modules\Generators\Readers\ReaderInterface;
use Petryashin\Modules\Generators\Traits\FileSystemPathHelpersTrait;
use Petryashin\Modules\Generators\Writers\WriterInterface;

abstract class AbstractStubCommand implements GeneratorInterface
{
    use FileSystemPathHelpersTrait;

    protected ?string $moduleName;

    public function __construct(
        protected WriterInterface $writer,
        protected ReaderInterface $reader,
    )
    {
    }

    public function setModuleName(string $moduleName): static
    {
        $this->moduleName = $moduleName;

        return $this;
    }

    abstract protected function getParamsForReplacement(): array;

    abstract protected function getModuleType(): string;

    public function execute(): void
    {
        $content = $this->getStubContent();

        $this->replaceAllPatterns($content);

        $directoryPath = $this->getCreatedDirectoryPath();

        $isSuccess = $this->createDirectory($directoryPath);

        if (!$isSuccess) {
            throw new CreateDirectoryException(CreateDirectoryException::MESSAGE . $this->getModulName());
        }

        $filePath = $this->getCreatedFilePath();
        $isSuccess = $this->createPattern($filePath, $content);

        if (!$isSuccess) {
            throw new CreateFileException(CreateFileException::MESSAGE . $this->getModulName());
        }
    }

    protected function createDirectory(string $path): bool
    {
        return $this->writer->createDirectory($path);
    }

    protected function createPattern(string $path, string $content): bool
    {
        return $this->writer->write($path, $content);
    }

    protected function replaceAllPatterns(string &$content)
    {
        foreach ($this->getParamsForReplacement() as $patternName => $replacement) {
            $this->replacePattern($content, $patternName, $replacement);
        }
    }

    protected function replacePattern(string &$content, string $patternName, string $replacement): void
    {
        $content = str_replace("{{ $patternName }}", $replacement, $content);
    }

    protected function getStubContent(): string
    {
        return $this->reader->read($this->getStubContentPath());
    }

}
