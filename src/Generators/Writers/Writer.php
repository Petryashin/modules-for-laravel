<?php

namespace Petryashin\Modules\Generators\Writers;

use Illuminate\Support\Facades\File;

class Writer implements WriterInterface
{
    public function write(string $path, string &$content): bool
    {
        return File::put($path, $content);
    }

    public function createDirectory(string $path): bool
    {
        try{
            File::ensureDirectoryExists($path);

            return true;
        } catch (\Exception $_){
            return false;
        }
    }
}
