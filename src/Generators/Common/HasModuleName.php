<?php

namespace Petryashin\Modules\Generators\Common;

interface HasModuleName
{
    public function setModuleName(string $moduleName): static;
    public function getModuleName(): string;
}
