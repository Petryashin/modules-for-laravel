<?php

namespace Console\Commands\Generators;

use Illuminate\Support\Str;
use Petryashin\Modules\Generators\Commands\AbstractCommand;
use Petryashin\Modules\Generators\Readers\Reader;
use Petryashin\Modules\Generators\Writers\Writer;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AbstractCommandTest extends TestCase
{
    private AbstractCommand $stub;

    public function setUp(): void
    {
        $this->stub = $this->getMockForAbstractClass(AbstractCommand::class, [
            resolve(Writer::class), resolve(Reader::class)
        ], mockedMethods: ["getModuleType"]);
    }

    public function additionProvider(): array
    {
        return [
            ["Tests", "test.stub"],
            ["ASD", "asd.stub"]
        ];
    }

    /**
     * @dataProvider additionProvider
     */
    public function testGetStubNameMethod($moduleName, $expect)
    {
        $class = new ReflectionClass(AbstractCommand::class);
        $method = $class->getMethod("getStubName");
        $method->setAccessible(true);

        $this->stub->expects($this->any())->method("getModuleType")
            ->will($this->returnValue($moduleName));

        $this->assertEquals($expect, $method->invokeArgs($this->stub, []));
    }

    public function additionProvider2(): array
    {
        return [
            ["Tests", "test.stub"],
            ["ASD", "asd.stub"]
        ];
    }

    /**
     * @dataProvider additionProvider2
     */
    public function testGetStubContentPath($moduleName, $fileName)
    {
        $class = new ReflectionClass(AbstractCommand::class);
        $method = $class->getMethod("getStubContentPath");
        $method->setAccessible(true);

        $resPath = Str::beforeLast($class->getFileName(), "Commands") . "Traits/../stubs/" . $fileName;

        $this->stub->expects($this->any())->method("getModuleType")
            ->will($this->returnValue($moduleName));

        $this->assertEquals($resPath, $method->invokeArgs($this->stub, []));
    }
}
