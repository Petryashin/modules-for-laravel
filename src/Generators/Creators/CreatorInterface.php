<?php

namespace Petryashin\Modules\Generators\Creators;

use Petryashin\Modules\Generators\Commands\GeneratorInterface;

interface CreatorInterface
{
    function getGenerator(string $className): GeneratorInterface;
}
