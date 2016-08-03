<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.08.2016
 * Time: 14:32
 */

namespace DrawerGraphsTests\Unit\Command;

use DrawerGraphsTests\PHPUnitHelper;

/**
 * Class CommandTest
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();
        $command = \DrawerGraphs\Command\Command::create($driver);
        $this->assertEquals($driver, PHPUnitHelper::getProtectedProperty($command, 'driver'));
    }

    public function testPrepare()
    {
        $script = "Test script";

        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->setMethods(['_', 'createScript'])
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject | \DrawerGraphs\Command\Command $command */
        $command = $this
            ->getMockBuilder(\DrawerGraphs\Command\Command::class)
            ->disableOriginalConstructor()
            ->setMethods(['buildCommandAndExec'])
            ->getMock();
        PHPUnitHelper::setProtectedProperty($command, 'driver', $driver);


        $driver
            ->expects($this->at(0))
            ->method('createScript')
            ->with($command)
            ->willReturn($script);

        $command
            ->expects($this->at(0))
            ->method('buildCommandAndExec')
            ->with($script);

        $command->prepare();
    }

    public function testRender()
    {
        $script = "Test script";
        $script_encode = base64_encode($script);

        /** @var \PHPUnit_Framework_MockObject_MockObject | \DrawerGraphs\Command\Command $command */
        $command = $this->getMockBuilder(\DrawerGraphs\Command\Command::class)
            ->disableOriginalConstructor()
            ->setMethods(['_'])
            ->getMock();

        $promise = $this->getMockBuilder('\stdClass')
            ->setMethods(['getString'])
            ->getMock();
        $promise->expects($this->at(0))
            ->method('getString')
            ->willReturn($script);
        $promise->expects($this->at(1))
            ->method('getString')
            ->willReturn($script);
        PHPUnitHelper::setProtectedProperty($command, 'object_promise', $promise);


        PHPUnitHelper::setProtectedProperty($command, 'output_format', \DrawerGraphs\Command\Command::FORMAT_SVG);
        $result = $command->render();
        $this->assertEquals(
            '<object type="image/svg+xml" data="data:image/svg+xml;charset=utf8;base64,' . $script_encode . '"></object>',
            $result
        );

        PHPUnitHelper::setProtectedProperty($command, 'output_format', \DrawerGraphs\Command\Command::FORMAT_PNG);
        $result = $command->render();
        $this->assertEquals(
            '<img src="data:image/' . \DrawerGraphs\Command\Command::FORMAT_PNG .  ';charset=utf8;base64,' . $script_encode . '" />',
            $result
        );
    }
}
