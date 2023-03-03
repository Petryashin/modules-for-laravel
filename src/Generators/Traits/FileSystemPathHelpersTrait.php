<?php

namespace Petryashin\Modules\Generators\Traits;

use Illuminate\Support\Str;
use Petryashin\Modules\Generators\Exceptions\ModuleNameIsNotSetException;

trait FileSystemPathHelpersTrait
{
    protected function getCreatedDirectoryPath(): string
    {
        return base_path("modules") . $this->getAdditionalNameSpace(DIRECTORY_SEPARATOR);
    }

    protected function getCreatedFilePath(): string
    {
        return $this->getCreatedDirectoryPath() . DIRECTORY_SEPARATOR . $this->getCreatingClassName() . ".php";
    }

    protected function getStubContentPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "stubs" . DIRECTORY_SEPARATOR . $this->getStubName();
    }

    private function getStubName(): string
    {
        return Str::singular(Str::lower($this->getModuleType())) . ".stub";
    }

    protected function getCreatingClassName(): string
    {
        return Str::ucfirst(Str::singular(Str::lower($this->getModuleType())));
    }

    protected function getModulName(): string
    {
        if (is_null($this->moduleName)) {
            throw new ModuleNameIsNotSetException();
        }

        return Str::ucfirst(Str::lower(trim($this->moduleName)));
    }

    protected function getAdditionalNameSpace($sep = "\\"): string
    {
        $baseNameSpace = $this->getModulName();

        return $sep . $baseNameSpace . $sep . $this->getModuleType();
    }

    protected function getFullNameSpace(): string
    {
        return "Modules" . $this->getAdditionalNameSpace();
    }
}
