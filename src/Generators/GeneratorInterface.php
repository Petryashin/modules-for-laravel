<?php

namespace Petryashin\Modules\Generators;

interface GeneratorInterface
{
    public function execute(): void;
    public function setModuleName(string $moduleName): static;
}
