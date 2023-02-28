<?php

namespace Petryashin\Modules\Console\Commands\Generators;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Petryashin\Modules\Console\Commands\BaseCommand;

abstract class AbstractStubCommand extends BaseCommand
{
    abstract protected function getParamsForReplacement(): array;

    abstract protected function getModuleType(): string;

    public function handle()
    {
        $content = $this->getStubContent();

        $this->replaceAllPatterns($content);

        $directoryPath = $this->getCreationDirectoryPath();
        $this->createDirectory($directoryPath);

        $filePath = $this->getCreationPath();
        $this->createPattern($filePath, $content);
    }

    protected function getCreationDirectoryPath(): string
    {
        return base_path("modules") . $this->getAdditionalNameSpace(DIRECTORY_SEPARATOR);
    }

    protected function getCreationPath(): string
    {
        return $this->getCreationDirectoryPath() . DIRECTORY_SEPARATOR . $this->getCreatingClassName() . ".php";
    }

    protected function createDirectory(string $path): void
    {
        File::ensureDirectoryExists($path);
    }

    protected function createPattern(string $path, string &$content): bool
    {
        return File::put($path, $content);
    }

    protected function replaceAllPatterns(string &$content)
    {
        foreach ($this->getParamsForReplacement() as $patternName => $replacement) {
            $this->replacePattern($content, $patternName, $replacement);
        }
    }

    protected function replacePattern(string &$content, string $patternName, string $replacement): void
    {
        $content = str_replace("{{ $patternName }}", $replacement, $content);
    }


    protected function getStubContent(): string
    {
        return file_get_contents($this->getStubContentPath());
    }

    protected function getStubContentPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . "stubs" . DIRECTORY_SEPARATOR . $this->getStubName();
    }

    private function getStubName(): string
    {
        return Str::singular(Str::lower($this->getModuleType())) . ".stub";
    }

    protected function getCreatingClassName(): string
    {
        return Str::ucfirst(Str::singular(Str::lower($this->getModuleType())));
    }

    protected function getAdditionalNameSpace($sep = "\\"): string
    {
        $baseNameSpace = parent::getModulName();

        return $sep . $baseNameSpace . $sep . $this->getModuleType();
    }

    protected function getFullNameSpace(): string
    {
        return "Modules" . $this->getAdditionalNameSpace();
    }


}
