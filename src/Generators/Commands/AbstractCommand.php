<?php

namespace Petryashin\Modules\Generators\Commands;

use Petryashin\Modules\Generators\Readers\ReaderInterface;
use Petryashin\Modules\Generators\Traits\FileSystemPathHelpersTrait;
use Petryashin\Modules\Generators\Writers\WriterInterface;

abstract class AbstractCommand implements GeneratorInterface
{
    use FileSystemPathHelpersTrait;

    protected ?string $moduleName;

    abstract protected function getModuleType(): string;

    public function __construct(
        protected WriterInterface $writer,
        protected ReaderInterface $reader,
    )
    {
    }

    abstract public function execute(): void;

    public function setModuleName(string $moduleName): static
    {
        $this->moduleName = $moduleName;

        return $this;
    }
}
