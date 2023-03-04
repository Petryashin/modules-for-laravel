<?php

namespace Petryashin\Modules\Generators\Commands;

use Petryashin\Modules\Generators\Common\HasModuleName;

interface GeneratorInterface extends HasModuleName
{
    public function execute(): void;
}
