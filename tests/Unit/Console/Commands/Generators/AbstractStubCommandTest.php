<?php

namespace Console\Commands\Generators;

use Illuminate\Support\Str;
use Petryashin\Modules\Console\Commands\Generators\AbstractStubCommand;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AbstractStubCommandTest extends TestCase
{
    private AbstractStubCommand $stub;

    public function setUp(): void
    {
        $this->stub = $this->getMockForAbstractClass(AbstractStubCommand::class);
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
        $class = new ReflectionClass(AbstractStubCommand::class);
        $method = $class->getMethod("getStubName");
        $method->setAccessible(true);

        $this->stub->expects($this->any())->method("getModuleName")
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
        $class = new ReflectionClass(AbstractStubCommand::class);
        $method = $class->getMethod("getStubContentPath");
        $method->setAccessible(true);

        $resPath = Str::beforeLast($class->getFileName(), "AbstractStubCommand") . "stubs/" . $fileName;

        $this->stub->expects($this->any())->method("getModuleName")
            ->will($this->returnValue($moduleName));

        $this->assertEquals($resPath, $method->invokeArgs($this->stub, []));
    }
}
