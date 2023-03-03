<?php

namespace Petryashin\Modules\Generators\Readers;

class Reader implements ReaderInterface
{
    public function read(string $path): string
    {
        return file_get_contents($path);
    }
}
