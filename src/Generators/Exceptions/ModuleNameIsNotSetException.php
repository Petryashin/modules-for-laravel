<?php

namespace Petryashin\Modules\Generators\Exceptions;

class ModuleNameIsNotSetException extends \Exception
{
    public const MESSAGE =  "Module Name Is Not Set";

    public function __construct()
    {
        parent::__construct();

        $this->message = self::MESSAGE;
    }
}
