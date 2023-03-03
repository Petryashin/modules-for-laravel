<?php

namespace Petryashin\Modules\Generators\Writers;

interface WriterInterface
{
    public function write(string $path, string &$content): bool;

    public function createDirectory(string $path): bool;
}
