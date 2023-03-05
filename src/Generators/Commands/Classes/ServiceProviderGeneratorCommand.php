<?php

namespace Petryashin\Modules\Generators\Commands\Classes;

class ServiceProviderGeneratorCommand extends AbstractStubCommand
{
    protected function getModuleType(): string
    {
        return "ServiceProvider";
    }

    protected function getParamsForReplacement(): array
    {
        return [
            "classname" => $this->getCreatingClassName(),
            "namespace" => $this->getFullNameSpace()
        ];
    }
}
