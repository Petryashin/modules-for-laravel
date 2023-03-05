<?php

namespace Petryashin\Modules\Generators\Commands\Classes;

class ServiceGeneratorCommand extends AbstractStubCommand
{
    protected function getModuleType(): string
    {
        return "Services";
    }

    protected function getParamsForReplacement(): array
    {
        return [
            "classname" => $this->getModuleName() . $this->getCreatingClassName(),
            "namespace" => $this->getFullNameSpace()
        ];
    }
}
