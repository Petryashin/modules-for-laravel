<?php

namespace Petryashin\Modules\Generators\Creators;

use Petryashin\Modules\Generators\Commands\GeneratorInterface;

class Creator implements CreatorInterface
{
    function getGenerator(string $className): GeneratorInterface
    {
        return resolve($className);
    }
}
