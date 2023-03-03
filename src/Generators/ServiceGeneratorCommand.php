<?php

namespace Petryashin\Modules\Generators;

class ServiceGeneratorCommand extends AbstractStubCommand
{
    protected function getModuleType(): string
    {
        return "Services";
    }

    protected function getParamsForReplacement(): array
    {
        return [
            "classname" => $this->getModulName() . $this->getCreatingClassName(),
            "namespace" => $this->getFullNameSpace()
        ];
    }
}
