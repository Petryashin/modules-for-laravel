<?php

namespace Petryashin\Modules\Generators\Commands\Directories;

class ActionDirectoryCommand extends AbstractDirectoryCommand
{

    protected function getModuleType(): string
    {
        return "Action";
    }
}
