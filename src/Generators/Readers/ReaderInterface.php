<?php

namespace Petryashin\Modules\Generators\Readers;

interface ReaderInterface
{
    public function read(string $path): string;
}
