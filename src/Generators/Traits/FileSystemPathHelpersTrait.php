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
        return (string) Str::of($this->getModuleType())->snake()->lower()->singular()->append('.stub') ;
    }

    protected function getCreatingClassName(): string
    {
        return $this->getModuleName()
            . ((string)Str::of($this->getModuleType())
                ->singular()
                ->ucfirst());
    }

    public function getModuleName(): string
    {
        if (is_null($this->moduleName)) {
            throw new ModuleNameIsNotSetException();
        }

        return (string)Str::of($this->moduleName)
            ->trim()
            ->lower()
            ->ucfirst();
    }

    protected function getAdditionalNameSpace($sep = "\\"): string
    {
        $baseNameSpace = $this->getModuleName();

        return $sep . $baseNameSpace . $sep . Str::plural($this->getModuleType());
    }

    protected function getFullNameSpace(): string
    {
        return "Modules" . $this->getAdditionalNameSpace();
    }
}
