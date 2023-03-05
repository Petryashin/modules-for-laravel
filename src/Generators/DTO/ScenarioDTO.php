<?php

namespace Petryashin\Modules\Generators\DTO;

final class ScenarioDTO
{
    private string $moduleName;

    /**
     * @return string
     */
    public function getModuleName(): string
    {
        return $this->moduleName;
    }

    /**
     * @param string $moduleName
     */
    public function setModuleName(string $moduleName): void
    {
        $this->moduleName = $moduleName;
    }

}
