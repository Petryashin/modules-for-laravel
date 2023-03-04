<?php

namespace Petryashin\Modules\Generators\Exceptions;

class CreateFileException extends \Exception
{
    public const MESSAGE =  "Failed to create a file in module";
    public const FILE_ALREADY_EXISTS =  "File already exists in";
}
