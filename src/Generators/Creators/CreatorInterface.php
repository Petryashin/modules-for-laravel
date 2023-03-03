<?php

namespace Petryashin\Modules\Generators\Creators;

use Petryashin\Modules\Generators\GeneratorInterface;

interface CreatorInterface
{
    function getGenerator(string $className): GeneratorInterface;
}
